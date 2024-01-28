<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Post;
use DataTables;
use App\Mail\SendMailable;
use App\Models\EmailTemplate;

use File;
use Mail;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OrderController extends Controller
{
    
    public function __construct()   
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('super_admin.manage_sales_order.manage_post');
    }


    public function addDeal(Request $request) {
        $data = array();
        $sale = Post::where('title','sales')->first();
        $data['main_service'] = Post::where('type','service')->where('service_id',@$sale->id)->get();
        return view('super_admin.manage_sales_order.add_post',$data);
    }

    public function editDeal($id) {
        $data = array();
        $data['order'] = Order::where('id',$id)->with(['items.product','items.harddisk','items.ram','items.warrenty','items.os'])->first();
        

        // echo "<pre>"; print_r($data['order']->toArray()); die;

        
        return view('super_admin.manage_sales_order.edit_post',$data);
    }


    public function saveDeal(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $rules = array(
                'tracking'           => 'required',
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
                
                $order = Order::find($data['order_id']);
                $order->tracking = $data['tracking'];
                $order->status = 2;
                $order->save();
                
                $template = EmailTemplate::find(18);
                $product = Post::where('id',$order->product_id)->first();
                $info = array();
                $patterns = array('{{name}}','{{product_name}}','{{product_price}}','{{url}}');
                $replacements = array($order->first_name.' '.$order->last_name, $product->title, $product->price, $data['tracking']);
                $info['email_body_text'] = str_replace($patterns,$replacements,$template->template);
                $info['subject'] = $template->subject;

                Mail::to($order->email)->send(new SendMailable($info));

                
                $result = array(
                    'success'=>true,
                    'status'=>true,
                    'message'=> 'Tracking Updated Successfully!',
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
        $data = Order::where('payment_status','!=', 1)->orderBy('updated_at','desc')->get();

        return Datatables::of($data)
        ->editColumn('user',function($data) {

            $list = '<p class="mb-2"><b>'.$data->first_name.' '.$data->last_name.'</b></p><p class="mb-2"><b>'.$data->email.'</b></p>';

            return $list;
        })
        ->editColumn('address',function($data) {
            return '<p class="">'.$data->address.'<br> '.$data->address_2.'<br> '.$data->state.', '.$data->zip_code.',  '.$data->country.'</p>';
        })
        ->editColumn('payment',function($data) {
            $checked= '';
            if($data->payment_status == 2) {
                $checked = '<span class="badge badge-success">Completed</span>';
            } else if($data->payment_status == 3) {
                $checked = '<span class="badge badge-danger">Failed</span>';
            }
            return $checked;
        })
        ->editColumn('price',function($data) {
            return $data->transaction_id;
        })->editColumn('status',function($data) {

            if($data->status == 1 || $data->status == null) {
                $checked = '<span class="badge badge-secondary text-white">New Order</span>';
            } else if($data->status == 2) {
                $checked = '<span class="badge badge-success">In Progress</span>';
            } else if($data->status == 3) {
                $checked = '<span class="badge badge-success">Completed</span>';
            } else {
                $checked = '<span class="badge badge-danger">Cancelled</span>';
            }
            return $checked;

        })->editColumn('created_at',function($data) {
            return date('Y-m-d g:i A',strtotime($data->created_at));
        })->editColumn('action',function($data) {
                $status = '<ul class="list-inline m-0">
                                 <li class="list-inline-item mail-unread mr-1 ml-1"><a href="'.url("/").'/view-sales-order/'.$data->id.'" class="action-icon font-medium-3" ><i class="mdi mdi-eye" ></i></a></li>
                                 
                            </ul>';
          
            return $status;
        })->rawColumns(['action','user','status','address','payment'])->make(true);
    }


    public function delete_deal(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();

            $order = Order::find($data['id']);
            $order->status = 3;
            $order->save();
            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'Order Completed Successfully!',
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
