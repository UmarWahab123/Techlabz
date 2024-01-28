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
use App\Models\BlogPost;
use App\Models\PostCategory;
use App\Models\Setting;
use App\Models\User;
use App\Models\Post;

use File;
use Mail;
use DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardController extends Controller
{
    public function __construct()
    {
    }


    public function login()
    {
        return view('super_admin.login');
    }

    public function index()
    {
        $data = [];
        $data['post_count'] = Post::where('type','post')->count();
        $data['blog_post_count'] = Post::where('type','blog_post')->count();
        return view('super_admin.dashboard',$data);
    }

    public function managePost(Request $request) {
        return view('super_admin.manage_post.manage_post');
    }

    public function addPost(Request $request) {
        
        return view('super_admin.manage_post.add_post');
    }

    public function editPost($id) {
        $data = array();
        $data['blog'] = Post::where('id',$id)->first();

        return view('super_admin.manage_post.edit_post',$data);
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
                $attachment->description = $data['description'];
                $attachment->type = 'post';
                
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
        $data = Post::where('type','post')->orderBy('id','desc')->get();

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

        })->editColumn('date',function($data) {
            return  '<ul class="list-inline m-0">
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="https://www.facebook.com/sharer/sharer.php?u='.route('blogpostdetail', ['slug' => $data->slug]).'" class="action-icon font-medium-3" id="" target="_blank"><span class="mdi mdi-facebook-box mdi-24px"></span></a></li>
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="https://twitter.com/intent/tweet?text='.$data->title.'; &amp;url='.route('blogpostdetail', ['slug' => $data->slug]).'" class="action-icon font-medium-3" id=""  target="_blank"><span class="mdi mdi-twitter-box mdi-24px"></span></a></li>
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.route('blogpostdetail', ['slug' => $data->slug]).'&amp;title='.$data->title.'&amp;summary='.$data->short_description.'" class="action-icon font-medium-3" id=""  target="_blank"><span class="mdi mdi-linkedin-box mdi-24px"></span></a></li>
                        <li class="list-inline-item mail-unread mr-2 ml-1"><a href="https://wa.me/?text='.route('blogpostdetail', ['slug' => $data->slug]).'" class="action-icon font-medium-3" id=""  target="_blank"><span class="mdi mdi-whatsapp mdi-24px"></span></a></li> 
                        </ul> ';
        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">

                                 <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-post/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-grease-pencil" ></i></a></li>

                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','image','status','date'])->make(true);
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


    public function setting()
    {
        $data = [];
        $data['setting'] = Setting::find(1);
        return view('super_admin.setting',$data);
    }

    public function saveSetting(Request $request)
    {
        
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $rules = array(
                'email'           => 'required',
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
                $attachment = Setting::find(1);
                if(empty($attachment)) {
                    $attachment = new Setting();
                }

                if(!empty($request->file('image'))) {
                    $file   = $request->file('image');
                    $orignal_file_name = $request->file('image')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('image')->getClientOriginalName());
                    $folder_path = 'slider';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url = 'storage/uploads/'.$folder_path.'/'.$filename;
                }


                if(!empty($request->file('image_2'))) {
                    $file   = $request->file('image_2');
                    $orignal_file_name = $request->file('image_2')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('image_2')->getClientOriginalName());
                    $folder_path = 'slider';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url_2 = 'storage/uploads/'.$folder_path.'/'.$filename;
                }



                if(!empty($request->file('image_3'))) {
                    $file   = $request->file('image_3');
                    $orignal_file_name = $request->file('image_3')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('image_3')->getClientOriginalName());
                    $folder_path = 'slider';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url_3 = 'storage/uploads/'.$folder_path.'/'.$filename;
                }

                if(!empty($request->file('logo'))) {
                    $file   = $request->file('logo');
                    $orignal_file_name = $request->file('logo')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('logo')->getClientOriginalName());
                    $folder_path = 'slider';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $logo_url_3 = 'storage/uploads/'.$folder_path.'/'.$filename;
                }


                if(!empty($request->file('image_4'))) {
                    $file   = $request->file('image_4');
                    $orignal_file_name = $request->file('image_4')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('image_4')->getClientOriginalName());
                    $folder_path = 'slider';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url_4 = 'storage/uploads/'.$folder_path.'/'.$filename;
                }

                if(isset($logo_url_3)) {
                    $attachment->logo = $logo_url_3;
                }

                if(isset($image_url)) {
                    $attachment->image = $image_url;
                }
                $attachment->slider_text = $data['slider_text'];

                if(isset($image_url_2)) {
                    $attachment->image_2 = $image_url_2;
                }
                $attachment->slider_text_2 = $data['slider_text_2'];

                if(isset($image_url_3)) {
                    $attachment->image_3 = $image_url_3;
                }
                $attachment->slider_text_3 = $data['slider_text_3'];

                if(isset($image_url_4)) {
                    $attachment->image_4 = $image_url_4;
                }
                $attachment->slider_text_4 = $data['slider_text_4'];

                $attachment->email = $data['email'];
                $attachment->phone = $data['phone'];
                $attachment->address = $data['address'];
                $attachment->about_us = $data['description'];
                $attachment->facebook_link = $data['facebook_link'];
                $attachment->twitter_link = $data['twitter_link'];
                $attachment->youtube_link = $data['youtube_link'];
                $attachment->instagram_link = $data['instagram_link'];
                $attachment->site_description = $data['site_description'];
                $attachment->site_title = $data['site_title'];

                $attachment->monday = $data['monday'];
                $attachment->tuesday = $data['tuesday'];
                $attachment->wednesday = $data['wednesday'];
                $attachment->thursday = $data['thursday'];
                $attachment->friday = $data['friday'];
                $attachment->saturday = $data['saturday'];
                $attachment->sunday = $data['sunday'];
                $attachment->footer_copyright_text = $data['footer_copyright_text'];

                $attachment->header_service_menu = $data['header_service_menu'];
                $attachment->header_blog_menu = $data['header_blog_menu'];
                $attachment->header_about_menu = $data['header_about_menu'];
                $attachment->header_contact_menu = $data['header_contact_menu'];
                $attachment->header_home_menu = $data['header_home_menu'];
                $attachment->header_phone = $data['header_phone'];
                $attachment->header_email = $data['header_email'];

                $attachment->save();
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Post Updated Successfully!',
                );

                return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Setting Updated Successfully!',
                    'data'=>''
                ]);

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


    public function profile()
    {
        $data = [];
        $data['setting'] = User::find(Auth::user()->id);
        return view('super_admin.profile',$data);
    }

    public function saveprofile(Request $request)
    {
        
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $rules = array(
                'email'           => 'required',
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
                    $folder_path = 'profile';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url = 'storage/uploads/'.$folder_path.'/'.$filename;
                }

                $attachment = User::find(Auth::user()->id);
                $attachment->email = $data['email'];
                $attachment->name = $data['name'];
                if(!empty($image_url)) {
                    $attachment->image = $image_url;
                }
                if(!empty($data['password'])) {
                    $attachment->password = Hash::make($data['password']);
                }
                
                $attachment->save();
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Post Updated Successfully!',
                );

                return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Profile Updated Successfully!',
                    'data'=>''
                ]);

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



    public function manageCategory(Request $request) {
        return view('super_admin.manage_category.manage_post');
    }

    public function addCategory(Request $request) {
        
        return view('super_admin.manage_category.add_post');
    }

    public function editCategory($id) {
        $data = array();
        $data['blog'] = Post::where('id',$id)->first();

        return view('super_admin.manage_category.edit_post',$data);
    }

    public function saveCategory(Request $request)
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
                if(!empty($data['id'])) {
                    $attachment = Post::find($data['id']);
                } else {
                    $attachment = new Post();
                    $attachment->status = 1;
                }
                $attachment->slug = SlugService::createSlug(Post::class, 'slug', $data['slug'], ['unique' => false]);
                $attachment->title = $data['title'];
                $attachment->type = 'blog_category';
                
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
    
    public function get_category_list()
    {
        $data = Post::where('type','blog_category')->orderBy('id','desc')->get();

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

                                 <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-category/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-grease-pencil" ></i></a></li>

                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','image','status','date'])->make(true);
    }


    public function update_category_status(Request $request)
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

    public function delete_category(Request $request)
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


}
