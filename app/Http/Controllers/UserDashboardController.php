<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use File;
use Auth;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = array();
        $data['order'] = Order::where('user_id',Auth::user()->id)->with(['items.product','items.harddisk','items.ram','items.warrenty','items.os'])->orderby('id','desc')->first();
        
        return view('front.user.dashboard',$data);
    }

    public function edit_profile(Request $request)
    {
        return view('front.user.profile');
    }


    public function saveprofile(Request $request)
    {
        
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $rules = array(
                'name'           => 'required',
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
                $attachment->phone = $data['phone'];
                $attachment->address = $data['address'];
                $attachment->country = $data['country'];
                $attachment->state = $data['state'];
                $attachment->zipcode = $data['zipcode'];
                if(!empty($image_url)) {
                    $attachment->image = $image_url;
                }
                
                $attachment->save();

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


    public function my_order(Request $request)
    {
        $data = array();
        $data['order_info'] = Order::where('user_id',Auth::user()->id)->with(['items.product','items.harddisk','items.ram','items.warrenty','items.os'])->get();

        return view('front.user.order',$data);
    }

    public function my_wishlist(Request $request)
    {
        return view('front.user.wishlist');
    }

}
