<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Deal;
use DataTables;

class AmazonController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('super_admin.manage_deal.manage_post');
    }


    public function addDeal(Request $request) {
        return view('super_admin.manage_deal.add_post');
    }

    public function editDeal($id) {
        $data = array();
        $data['blog'] = Deal::where('id',$id)->first();
        return view('super_admin.manage_deal.edit_post',$data);
    }


    public function saveDeal(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $rules = array(
                'deal'           => 'required',
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
                    $attachment = Deal::find($data['id']);
                } else {
                    $attachment = new Deal();
                }
                $attachment->title = $data['title'];
                $attachment->deal = $data['deal'];
                $attachment->save();
                
                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Deal Updated Successfully!',
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
        $data = Deal::orderBy('updated_at','desc')->get();

        return Datatables::of($data)
        ->editColumn('title',function($data) {
            return $data->title;
        })->editColumn('created_at',function($data) {
            return date('Y-m-d g:i A',strtotime($data->created_at));
        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">
                            <li class="list-inline-item mail-unread mr-2 ml-1"><a href="'.url("/").'/edit-deal/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-pencil" ></i></a></li>

                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="javascript:;" class="action-icon font-medium-3" data-id="'.$data->id.'"onclick="delete_post(this)"><i class="mdi mdi-close-circle" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','date'])->make(true);
    }


    public function delete_deal(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();

            Deal::where('id',$data['id'])->delete();
                
            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Deal Deleted Successfully!',
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
