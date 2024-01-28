<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\HomeSetting;
use File;
use DataTables;

class SettingController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function seoSetting()
    {
        $data = [];
        $data['setting'] = Setting::find(1);
        return view('super_admin.seo-setting',$data);
    }

    public function homeSetting()
    {
        $data = [];
        $data['setting'] = HomeSetting::find(1);
        return view('super_admin.home-setting',$data);
    }

    public function saveSeoSetting(Request $request)
    {
        
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $rules = array(
                'home_meta_title'           => 'required',
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

                $attachment->home_meta_title = $data['home_meta_title'];
                $attachment->home_meta_keyword = $data['home_meta_keyword'];
                $attachment->home_meta_description = $data['home_meta_description'];
                $attachment->service_meta_title = $data['service_meta_title'];
                $attachment->service_meta_keyword = $data['service_meta_keyword'];
                $attachment->service_meta_description = $data['service_meta_description'];
                $attachment->about_meta_title = $data['about_meta_title'];
                $attachment->about_meta_keyword = $data['about_meta_keyword'];
                $attachment->about_meta_description = $data['about_meta_description'];
                $attachment->contact_meta_title = $data['contact_meta_title'];
                $attachment->contact_meta_keyword = $data['contact_meta_keyword'];
                $attachment->contact_meta_description = $data['contact_meta_description'];

                $attachment->save();
                
                
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


    public function savehomeSetting(Request $request)
    {
        
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $rules = array(
                'section_title_1'           => 'required',
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
                $attachment = HomeSetting::find(1);
                if(empty($attachment)) {
                    $attachment = new HomeSetting();
                }

                if(!empty($request->file('section_image_2'))) {
                    $file   = $request->file('section_image_2');
                    $orignal_file_name = $request->file('section_image_2')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('section_image_2')->getClientOriginalName());
                    $folder_path = 'slider';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url = 'storage/uploads/'.$folder_path.'/'.$filename;
                }


                if(!empty($request->file('section_image_3'))) {
                    $file   = $request->file('section_image_3');
                    $orignal_file_name = $request->file('section_image_3')->getClientOriginalName();
                    $filename    = time().'_'.preg_replace('/\s+/', '_', $request->file('section_image_3')->getClientOriginalName());
                    $folder_path = 'slider';
                    $destinationPath = storage_path("app/public/uploads/".$folder_path.'/');
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $file->move($destinationPath, $filename);
                    $image_url_2 = 'storage/uploads/'.$folder_path.'/'.$filename;
                }


                if(isset($image_url)) {
                    $attachment->section_image_2 = $image_url;
                }

                if(isset($image_url_2)) {
                    $attachment->section_image_3 = $image_url_2;
                }
                

                $attachment->section_title_1 = $data['section_title_1'];
                $attachment->section_description_1 = $data['section_description_1'];
                $attachment->section_title_2 = $data['section_title_2'];
                $attachment->section_description_2 = $data['section_description_2'];
                $attachment->section_title_3 = $data['section_title_3'];
                $attachment->section_description_3 = $data['section_description_3'];
                $attachment->section_title_4 = $data['section_title_4'];
                $attachment->section_description_4 = $data['section_description_4'];
                $attachment->section_title_5 = $data['section_title_5'];
                $attachment->section_description_5 = $data['section_description_5'];
                $attachment->section_title_6 = $data['section_title_6'];
                $attachment->section_description_6 = $data['section_description_6'];

                $attachment->service_title = $data['service_title'];
                $attachment->amazon_section = $data['amazon_section'];

                $attachment->why_title = $data['why_title'];
                
                $attachment->save();
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
}
