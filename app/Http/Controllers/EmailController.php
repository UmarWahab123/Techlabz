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
use App\Models\EmailTemplate;

use File;
use Mail;
use DataTables;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [];
        return view('super_admin.email_template.manage_template',$data);
    }

    public function get_template_list()
    {
        $data = EmailTemplate::get();

        return Datatables::of($data)
        ->editColumn('title',function($data) {
            return $data->email_type;
        })->editColumn('subject',function($data) {
            return $data->subject;
        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">

                                 <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-template/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-grease-pencil" ></i></a></li>
                            </ul>';
          
            return $status;
        })->rawColumns(['action'])->make(true);
    }


    public function editTemplate($id) {
        $data = array();
        $data['blog'] = EmailTemplate::where('id',$id)->first();

        return view('super_admin.email_template.edit_template',$data);
    }


    public function saveTemplate(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $rules = array(
                'subject'           => 'required',
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
                
                $attachment = EmailTemplate::find($data['id']);
                $attachment->subject = $data['subject'];
                $attachment->template = $data['template'];
                $attachment->save();
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Email Template Updated Successfully!',
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

}
