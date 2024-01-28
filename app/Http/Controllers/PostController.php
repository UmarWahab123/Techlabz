<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Lang;
use Auth;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Service;
use App\Models\RepairServiceCategory;


use File;
use Mail;
use DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function managePost(Request $request) {
        return view('super_admin.manage_blog_post.manage_post');
    }

    public function addPost(Request $request) {
        $data = [];
        $data['category'] = Post::where('status',1)->where('type','blog_category')->get();
        return view('super_admin.manage_blog_post.add_post',$data);
    }

    public function editPost($id) {
        $data = array();
        $data['blog'] = Post::where('id',$id)->first();
        $data['category'] = Post::where('status',1)->where('type','blog_category')->get();
        return view('super_admin.manage_blog_post.edit_post',$data);
    }

    public function savePost(Request $request)
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

                if(!empty($data['id'])) {
                    $attachment = Post::find($data['id']);
                } else {
                    $attachment = new Post();
                    $attachment->status = 1;
                }

                $attachment->slug = SlugService::createSlug(Post::class, 'slug', $data['slug'], ['unique' => false]);
                $attachment->title = $data['title'];
                $attachment->short_description = $data['short_description'];
                $attachment->category_id = $data['category_id'];
                $attachment->description = $data['description'];
                $attachment->meta_title = $data['meta_title'];
                $attachment->type = 'blog_post';
                $attachment->meta_description = $data['meta_description'];
                $attachment->meta_keyword = $data['meta_keyword'];
                
                if(isset($image_url)) {
                    $attachment->image = $image_url;
                }
                $attachment->save();
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Post Updated Successfully!',
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
    
    public function get_blog_list()
    {
        $data = Post::where('type','blog_post')->get();

        return Datatables::of($data)
        ->editColumn('image',function($data) {
            if(!empty($data->image)) {
                $list = '<img src="'.url('/public').'/'.$data->image.'" alt="product-pic" style="height:100px; width:100px;">';
            } else {
                $list = '<img src="https://img2.pngio.com/documentation-screenshotlayer-api-default-png-250_250.png" alt="product-pic" style="height:100px; width:100px;>';
            }
            return $list;
        })
        ->editColumn('title',function($data) {
            return strlen($data->title) > 35 ? substr($data->title,0,35)."..." : $data->title;
        })->editColumn('status',function($data) {

            if($data->status == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }
            return '<div class="switchery-demo">    
                        <input type="checkbox" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#ff5d48" class="jswitch" '.$checked.' data-id="'.$data->id.'">
                    </div>';

        })->editColumn('share',function($data) {
            return  '<ul class="list-inline m-0">
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="https://www.facebook.com/sharer/sharer.php?u='.route('postdetail', ['slug' => $data->slug]).'" class="action-icon font-medium-3" id="" target="_blank"><span class="mdi mdi-facebook-box mdi-24px"></span></a></li>
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="https://twitter.com/intent/tweet?text='.$data->title.'; &amp;url='.route('postdetail', ['slug' => $data->slug]).'" class="action-icon font-medium-3" id=""  target="_blank"><span class="mdi mdi-twitter-box mdi-24px"></span></a></li>
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.route('postdetail', ['slug' => $data->slug]).'&amp;title='.$data->title.'&amp;summary='.$data->short_description.'" class="action-icon font-medium-3" id=""  target="_blank"><span class="mdi mdi-linkedin-box mdi-24px"></span></a></li>
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="https://wa.me/?text='.route('postdetail', ['slug' => $data->slug]).'" class="action-icon font-medium-3" id=""  target="_blank"><span class="mdi mdi-whatsapp mdi-24px"></span></a></li> 
                        </ul> ';
        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">

                                 <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/post/edit-post/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-grease-pencil" ></i></a></li>

                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','image','status','share'])->make(true);
    }


    public function update_post_status(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $list = Post::find($data['id']);
            $list->status = $data['status'];
            $list->save();

            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'',
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

    public function delete_post(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();

            Post::where('id',$data['id'])->delete();
                
            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Post Deleted Successfully!',
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


    public function manageService(Request $request) {
        return view('super_admin.manage_service.manage_post');
    }

    public function editService($id = null) {
        $data = array();
        if(!empty($id)) {
            $data['blog'] = Post::where('id',$id)->first();
        }
        return view('super_admin.manage_service.edit_post',$data);
    }

    public function saveService(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            // dd($data);
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
                if(!empty($data['id'])) {

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
                    $folder_path = 'service';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url = 'storage/uploads/'.$folder_path.'/'.$filename;
                }

                $attachment->title = $data['title'];
                $attachment->meta_title = $data['meta_title'];
                $attachment->meta_keyword = $data['meta_keyword'];
                $attachment->meta_description = $data['meta_description'];
                $attachment->description = $data['text'];
                $attachment->type = 'main_service';
                if(isset($image_url)) {
                    $attachment->image = $image_url;
                }
                
                $attachment->save();
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Service Updated Successfully!',
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
    
    public function get_service_list()
    {
        $data = Post::where('type','main_service')->orderBy('id','desc')->get();

        return Datatables::of($data)
        ->editColumn('title',function($data) {
            return strlen($data->title) > 35 ? substr($data->title,0,35)."..." : $data->title;
        })->editColumn('status',function($data) {

            if($data->status == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }
            return '<div class="switchery-demo">    
                        <input type="checkbox" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#ff5d48" class="jswitch" '.$checked.' data-id="'.$data->id.'">
                    </div>';

        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">

                            <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-service/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-grease-pencil" ></i></a></li>

                            <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>

                            </ul>';
          
            return $status;
        })->rawColumns(['action','status','date'])->make(true);
    }

    public function update_service_status(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $list = Post::find($data['id']);
            $list->status = $data['status'];
            $list->save();

            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'',
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
    

    public function manageSubService(Request $request) {
        return view('super_admin.manage_sub_service.manage_post');
    }

    public function editSubService($id = null) {
        // dd("test");
        $data = array();
        $data['main_service'] = Post::where('type','main_service')->get();
        $data['sub_services'] = Service::where('status',1)->get();
        if(!empty($id)) {
            $data['blog'] = RepairServiceCategory::where('id',$id)->first();
        }
        return view('super_admin.manage_sub_service.edit_post',$data);
    }

    public function saveSubService(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            // dd($data);
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
                if(!empty($data['id'])) {
                    $attachment = RepairServiceCategory::find($data['id']);

                } else {
                    $attachment = new RepairServiceCategory();
                    $attachment->status = 1;
                    
                }

                $attachment->slug = SlugService::createSlug(RepairServiceCategory::class, 'slug', $data['slug'], ['unique' => false]);
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $original_file_name = $file->getClientOriginalName();
                    $filename = time() . "_" . $original_file_name;
                    $file->move(public_path('uploads/service'), $filename);
                    $image_url = 'uploads/service/' . $filename;
                }
                
                $attachment->title = $data['title'];
                $attachment->type = $data['type'];
                $attachment->service_id = $data['service_id'];
                $attachment->sub_service_id = $data['sub_service_id'];
                $attachment->meta_title = $data['meta_title'];
                $attachment->meta_keyword = $data['meta_keyword'];
                $attachment->meta_description = $data['meta_description'];
                $attachment->description	= $data['description'];
                $attachment->short_description	= $data['short_description'];
                // $attachment->type = 'service';
                if(isset($image_url)) {
                    $attachment->image = $image_url;
                }
                
                $attachment->save();
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Service Updated Successfully!',
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
    
    public function get_sub_service_list()
    {
        $data = RepairServiceCategory::with(['latest_service','new_sub_service'])->orderBy('id','desc')->get();
        // dd($data);

        return Datatables::of($data)
        ->editColumn('service',function($data) {
            return @$data->latest_service->title;
        })
        ->editColumn('sub_service',function($data) {
            return @$data->new_sub_service->title;
        })
        ->editColumn('title',function($data) {
            return strlen($data->title) > 35 ? substr($data->title,0,35)."..." : $data->title;
        })->editColumn('status',function($data) {

            if($data->status == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }
            return '<div class="switchery-demo">    
                        <input type="checkbox" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#ff5d48" class="jswitch" '.$checked.' data-id="'.$data->id.'">
                    </div>';

        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">

                            <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-sub-service/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-grease-pencil" ></i></a></li>
                                 
                            <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>

                            </ul>';
          
            return $status;
        })->rawColumns(['action','status','date'])->make(true);
    }

}
