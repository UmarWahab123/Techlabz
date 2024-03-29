<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Post;
use DataTables;

use File;
use Mail;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SalesCategoryController extends Controller
{
    
    public function __construct()   
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('super_admin.manage_sales_category.manage_post');
    }


    public function addDeal(Request $request) {
        $data = array();
        $sale = Post::where('title','sales')->first();
        $data['main_service'] = Post::where('type','service')->where('service_id',@$sale->id)->get();
        return view('super_admin.manage_sales_category.add_post',$data);
    }

    public function editDeal($id) {
        $data = array();
        $sale = Post::where('title','sales')->first();
        $data['main_service'] = Post::where('type','service')->where('service_id',@$sale->id)->get();

        $data['blog'] = Post::where('id',$id)->first();
        return view('super_admin.manage_sales_category.edit_post',$data);
    }


    public function saveDeal(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $rules = array(
                'category'           => 'required',
            );
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $messages  = $validator->messages();
                $first_msg = '';
                foreach ($messages->all() as $message) {
                    $first_msg = stripcslashes($message);
                    break;
                }
                $result = array(
                    "success" => false,
                    "error"   => $first_msg,
                );
            } else {
                
                if(isset($data['id']) && !empty($data['id'])) {
                    $attachment = Post::find($data['id']);
                } else {
                    $attachment = new Post();
                    $attachment->status = 1;
                }

                $attachment->slug = SlugService::createSlug(Post::class, 'slug', $data['slug'], ['unique' => false]);

                if(!empty($request->file('image'))) {
                    $file   = $request->file('image');
                    $orignal_file_name = $request->file('image')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('image')->getClientOriginalName());
                    $folder_path = 'brand_type';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url = 'storage/uploads/'.$folder_path.'/'.$filename;
                }

                $attachment->service_id = $data['category_id'];
                $attachment->title = $data['category'];
                if(isset($image_url)) {
                    $attachment->image = $image_url;
                }
                $attachment->meta_title = $data['meta_title'];
                $attachment->meta_description = $data['meta_description'];
                $attachment->meta_keyword = $data['meta_keyword'];
                $attachment->type = 'sub_service';
                $attachment->save();
                
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Category Updated Successfully!',
                );

                return response()->json($result);

            }
        } else {
            $result = array(
                "success" => false,
                'status'=>false,
                'message'=>'Something went wrong!',
            );
        }
        return response()->json($result);
    }
    
    public function get_deals_list()
    {
        $data = Post::where('type','sub_service')->orderBy('updated_at','desc')->get();

        return Datatables::of($data)
        ->editColumn('title',function($data) {
            return $data->title;
        })->editColumn('status',function($data) {

            if($data->status == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }
            return '<div class="switchery-demo">    
                        <input type="checkbox" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#ff5d48" class="jswitch" '.$checked.' data-id="'.$data->id.'">
                    </div>';

        })->editColumn('created_at',function($data) {
            return date('Y-m-d g:i A',strtotime($data->created_at));
        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">
                            <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-sales-category/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-pencil" ></i></a></li>

                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','date','status'])->make(true);
    }


    public function delete_deal(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();

            Post::where('id',$data['id'])->delete();
                
            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Category Deleted Successfully!',
                    'data'=>''
            ]);

        } else {
            $result = array(
                "success" => false,
                'status'=>false,
                'message'=>'Something went wrong!',
            );
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
    }


}
