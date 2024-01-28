<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactMessage;
use App\Models\Contact;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAdminMailable;
use DataTables;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manageContact(Request $request) {
        return view('super_admin.manage_contact.manage_post');
    }

    public function editContact($id) {
        $data = array();
        $data['blog'] = Contact::where('id',$id)->with(['messages'])->first();
        $con = Contact::find($id);
        $con->status = 1;
        $con->save();
        return view('super_admin.manage_contact.edit_post',$data);
    }

    public function saveContact(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $rules = array(
                'message'           => 'required',
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
                $attachment = Contact::find($data['id']);
                $attachment->admin_reply = $data['message'];
                $attachment->save();
                
                $message = new ContactMessage();
                $message->contact_id = $attachment->id;
                $message->name = 'Admin';
                $message->message = $data['message'];
                $message->save();

                $contact = Contact::find($data['id']);
                
                $info = $contact;
                $template = EmailTemplate::find(15);
                $data = array();
                $patterns = array('{{message}}','{{user_name}}');
                $replacements = array($message->message,$info->name);
                $data['email_body_text'] = str_replace($patterns,$replacements,$template->template);
                $data['subject'] = $template->subject;

                Mail::to($contact->email)->send(new SendAdminMailable($data));

                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Message Send Successfully!',
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
    
    public function get_contact_list()
    {
        $data = Contact::orderBy('updated_at','desc')->get();

        return Datatables::of($data)
        ->editColumn('title',function($data) {
            return $data->name;
        })->editColumn('email',function($data) {
            return $data->email;
        })->editColumn('status',function($data) {

            if($data->status == 1) {
                $checked = '<div class="badge badge-success">Read</div>';
            } else {
                $checked = '<div class="badge badge-warning">UnRead</div>';
            }
            return $checked;

        })->editColumn('created_at',function($data) {
            return date('Y-m-d g:i A',strtotime($data->created_at));
        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">

                                 <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/view-contact/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-eye" ></i></a></li>

                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','image','status','date'])->make(true);
    }


    public function delete_contact(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();

            Contact::where('id',$data['id'])->delete();
                
            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Message Deleted Successfully!',
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
