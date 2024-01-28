<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\PostImage;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\PostExtra;
use DataTables;

use File;
use Mail;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SalesProductController extends Controller
{
    
    public function __construct()   
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('super_admin.manage_product.manage_post');
    }


    public function addDeal(Request $request) {
        $data = array();
        $sale = Post::where('title','Sales')->first();
        $data['main_service'] = Post::where('type','service')->where('service_id',@$sale->id)->get();
        $data['sub_service'] = Post::where('type','sub_service')->get();
        $data['brand'] = Brand::get();
        return view('super_admin.manage_product.edit_post',$data);
    }

    public function editDeal($id) {
        $data = array();
        $sale = Post::where('title','Sales')->first();
        $data['main_service'] = Post::where('type','service')->where('service_id',@$sale->id)->get();
        $data['sub_service'] = Post::where('type','sub_service')->get();
        $data['brand'] = Brand::get();

        $data['blog'] = Post::where('id',$id)->with(['images','tags'])->first();

        $data['hard_disk'] = PostExtra::where('post_id',$id)->where('type','hard_disk')->get();
        $data['ram'] = PostExtra::where('post_id',$id)->where('type','ram')->get();
        $data['warrenty'] = PostExtra::where('post_id',$id)->where('type','warrenty')->get();
        $data['os'] = PostExtra::where('post_id',$id)->where('type','os')->get();


        // echo "<pre>"; print_r($data['blog']->toArray()); die;
        return view('super_admin.manage_product.edit_post',$data);
    }


    public function saveDeal(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $rules = array(
                'title'           => 'required',
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

                $attachment->service_id = $data['service_id'];
                $attachment->sub_service_id = $data['sub_service_id'];
                $attachment->brand_id = $data['brand_id'];
                $attachment->meta_title = $data['meta_title'];
                $attachment->meta_keyword = $data['meta_keyword'];
                $attachment->meta_description = $data['meta_description'];
                $attachment->price = $data['price'];
                $attachment->short_description = $data['short_description'];
                $attachment->grade = $data['grade'];
                $attachment->processer = $data['processer'];
                // $attachment->description = $data['text'];
                $attachment->title = $data['title'];
                if(isset($image_url)) {
                    $attachment->image = $image_url;
                }
                $attachment->type = 'product';
                $attachment->save();
                
                if(!empty(@$data['tags'])) {
                    $tags = explode(',', @$data['tags']);
                    PostTag::where('post_id', $attachment->id)->delete();
                    foreach ($tags as $key => $val) {
                        
                        $ta = new PostTag();
                        $ta->post_id = $attachment->id;
                        $ta->tag_name = $val;
                        $ta->save();
                    }

                }
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'data'=> $attachment,
                    'message'=> 'Product Updated Successfully!',
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
    
    public function saveAddon(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            
            if(!empty($data['disk'])) {
                foreach ($data['disk'] as $key => $val) {
                    
                    if(!empty($data['disk_id'][$key])){
                        $li = PostExtra::find($data['disk_id'][$key]);
                    } else {
                        $li = new PostExtra();
                    }
                    
                    $li->name = $val;
                    $li->post_id = $data['id'];
                    $li->type = 'hard_disk';
                    $li->price = $data['disk_price'][$key];
                    $li->save();
                }
            }

            if(!empty($data['ram'])) {
                foreach ($data['ram'] as $key => $val) {
                    
                    if(!empty($data['ram_id'][$key])){
                        $li = PostExtra::find($data['ram_id'][$key]);
                    } else {
                        $li = new PostExtra();
                    }
                    $li->name = $val;
                    $li->post_id = $data['id'];
                    $li->type = 'ram';
                    $li->price = $data['ram_price'][$key];
                    $li->save();
                }
            }


            if(!empty($data['warrenty'])) {
                foreach ($data['warrenty'] as $key => $val) {
                    
                    if(!empty($data['warrenty_id'][$key])){
                        $li = PostExtra::find($data['warrenty_id'][$key]);
                    } else {
                        $li = new PostExtra();
                    }
                    $li->name = $val;
                    $li->post_id = $data['id'];
                    $li->type = 'warrenty';
                    $li->price = $data['warrenty_price'][$key];
                    $li->save();
                }
            }

            if(!empty($data['os'])) {
                foreach ($data['os'] as $key => $val) {
                    
                    if(!empty($data['os_id'][$key])){
                        $li = PostExtra::find($data['os_id'][$key]);
                    } else {
                        $li = new PostExtra();
                    }
                    $li->name = $val;
                    $li->post_id = $data['id'];
                    $li->type = 'os';
                    $li->price = $data['os_price'][$key];
                    $li->save();
                }
            }

            
            $result = array(
                'success'=>true,
                'status'=>true,
                'message'=> 'Product Add Ons Updated Successfully!',
            );

            return response()->json($result);

        }   
    }

    public function saveDescription(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            
                
                $attachment = Post::find($data['id']);
                $attachment->specification = $data['specification'];
                $attachment->description = $data['description'];
                $attachment->grading = $data['grading'];
                $attachment->others = $data['others'];
                $attachment->save();
            
            $result = array(
                'success'=>true,
                'status'=>true,
                'message'=> 'Product Specification Updated Successfully!',
            );

            return response()->json($result);

        }   
    }


    public function saveImages(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            
            foreach ($request->file('images') as $imagefile) {
                
                $attachment = new PostImage();

                $file = $imagefile;
                $orignal_file_name = $imagefile->getClientOriginalName();
                $filename    = time().'_'.preg_replace('/\s+/', '_', $imagefile->getClientOriginalName());
                $folder_path = 'brand_type';
                $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }
                $file->move($destinationPath, $filename);
                $image_url = 'storage/uploads/'.$folder_path.'/'.$filename;

                if(isset($image_url)) {
                    $attachment->image = $image_url;
                }
                $attachment->post_id = $data['id'];
                $attachment->save();

            }
            
            $result = array(
                'success'=>true,
                'status'=>true,
                'message'=> 'Product Images Updated Successfully!',
            );

            return response()->json($result);

        }   
    }


    public function get_deals_list()
    {
        $data = Post::where('type','product')->with(['service','sub_service','brand'])->orderBy('updated_at','desc')->get();

        return Datatables::of($data)
        ->editColumn('title',function($data) {
            return $data->title;
        })
        ->editColumn('service',function($data) {
            return @$data->service->title;
        })->editColumn('sub_service',function($data) {
            return @$data->sub_service->title;
        })->editColumn('brand',function($data) {
            return @$data->brand->title;
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
                            <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-sales-product/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-pencil" ></i></a></li>

                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','date','status'])->make(true);
    }

    public function delete_image(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();

            PostImage::where('id',$data['id'])->delete();
                
            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Image Deleted Successfully!',
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

    public function delete_addon(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();

            PostExtra::where('id',$data['id'])->delete();
                
            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Add On Deleted Successfully!',
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
