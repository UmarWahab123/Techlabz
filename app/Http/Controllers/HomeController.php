<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Brand;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Contact;
use App\Models\RepairContact;
use App\Models\RepairContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Models\EmailTemplate;
use App\Models\HomeSetting;
use App\Models\ContactMessage;
use App\Models\Deal;
use App\Models\PostImage;
use App\Models\PostTag;
use App\Models\OrderItem;
use App\Models\PostExtra;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Models\RepairServiceCategory;


class HomeController extends Controller
{
    // public function index2($slug = null)
    // {
    //     $data = array();
    //     $data['home_setting'] = HomeSetting::find(1);
    //     $data['setting'] = Setting::find(1);
    //     $data['deals'] = Deal::get();
    //     $data['blog_post'] = Post::where('status',1)->where('type','blog_post')->orderBy('id', 'desc')->take(3)->get();
    //     $data['service'] = Post::where('status',1)->where('type','main_service')->get();
    //     $sub_service = Post::where('slug','mini-pc')->first();
    //     $data['products'] = array();
    //     if(!empty($sub_service)) {
    //         $data['products'] = Post::where('status',1)->where('type','product')->where('sub_service_id',$sub_service->id)->orderBy('id', 'desc')->get();
    //     }
    //     $repair = Post::where('slug','repair')->first();
    //     $data['repair_service'] = Post::where('status',1)->where('type','service')->where('service_id',$repair->id)->get();
    //     return view('front.index',$data);

    // }
    public function index($slug = null)
    {
//  dd($data);
        $data = array();
        $data['home_setting'] = HomeSetting::find(1);
        $data['setting'] = Setting::find(1);
        $data['deals'] = Deal::get();
        $data['blog_post'] = Post::where('status',1)->where('type','blog_post')->orderBy('id', 'desc')->take(3)->get();
        $data['service'] = Post::where('status',1)->where('type','main_service')->get();
        $sub_service = Post::where('slug','mini-pc')->first();
        $data['products'] = array();
        if(!empty($sub_service)) {
            $data['products'] = Post::where('status',1)->where('type','product')->where('sub_service_id',$sub_service->id)->orderBy('id', 'desc')->get();
        }

        $repair = Post::where('slug','repair')->first();
        $data['repair_service'] = Post::where('status',1)->where('type','service')->where('service_id',$repair->id)->get();

        
        return view('front.index2',$data);

    }

    function more_data(Request $request){
        
        if (!empty($_POST)) {
            $data = $request->all();

            $skip=$data['skip'];
            $take=5;
            $products=Post::where('status',1)->where('type','post')->orderBy('id', 'desc')->skip($skip)->take($take)->get();
            
            return response()->json($products);
        }else{
            $data = Post::where('status',1)->where('type','post')->orderBy('id', 'desc')->take(5)->get();
            return response()->json($data);
        }
    }

    public function post($slug = NULL)
    {

        if(!empty($slug)) {

            $post = Post::where('slug',$slug)->first();

            if($post->type == 'blog_post') {
                $data = array();
                $data['category'] = Post::where('status',1)->where('type','blog_category')->orderBy('id', 'desc')->get();
                $data['setting'] = Setting::find(1);
                $data['blog_post'] = Post::where('slug',$slug)->first();
                
                $data['related_post'] = Post::where('category_id',$data['blog_post']->category_id)->take(6)->get();

                return view('front.blog_post_detail',$data);
                
            } else if($post->type == 'post') {
                
                $data = array();
                $data['setting'] = Setting::find(1);
                $data['blog_post'] = Post::where('slug',$slug)->first();
                return view('front.post_detail',$data);
        
            }

        } else {

            $data = array();
            $data['category'] = Post::where('status',1)->where('type','blog_category')->orderBy('id', 'desc')->get();
            $data['blog_post'] = Post::where('status',1)->orderBy('id', 'desc')->where('type','blog_post')->paginate(9);
            return view('front.post',$data);

        }

        
    }

    public function postCategory($slug)
    {
        $data = array();
        $data['category'] = Post::where('status',1)->where('type','blog_category')->orderBy('id', 'desc')->get();
        $category = Post::where('status',1)->where('slug',$slug)->orderBy('id', 'desc')->first();
        $data['blog_post'] = Post::where('status',1)->where('category_id',$category->id)->orderBy('id', 'desc')->paginate(9);
        return view('front.post',$data);
    }

    public function post_detail($slug=NULL)
    {
        
    }

    public function blog_post_detail($slug=NULL)
    {
        $data = array();
        $data['category'] = PostCategory::where('status',1)->orderBy('id', 'desc')->get();
        $data['setting'] = Setting::find(1);
        $data['blog_post'] = Post::where('slug',$slug)->first();
        return view('front.blog_post_detail',$data);
    }

    public function about_us()
    {
        $data = array();
        $data['setting'] = Setting::find(1);
        return view('front.about_us',$data);
    }

    public function contact_us(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $contact = Contact::where('email',$data['email'])->first();

            if(!empty($contact->id)) {
                $contact = Contact::find($contact->id);
            } else {
                $contact = new Contact();
            }
            
            $contact->email = $data['email'];
            $contact->name = $data['name'];
            $contact->message = $data['message'];
            $contact->status = 0;
            $contact->save();
            $setting = Setting::first();

            $message = new ContactMessage();
            $message->contact_id = $contact->id;
            $message->name = $data['name'];
            $message->message = $data['message'];
            $message->save();

            $info = $contact;
            $template = EmailTemplate::find(14);
            $data = array();
            $patterns = array('{{message}}');
            $replacements = array($info->message);
            $data['email_body_text'] = str_replace($patterns,$replacements,$template->template);
            $data['subject'] = $template->subject;

            Mail::to($setting->email)->send(new SendMailable($data));
            $result = array(
                'success'=>true,
                'status'=>true,
                'message'=> 'Message Sent Successfully!',
            );

            return response()->json([
                "success" => true,
                'status'=>true,
                'message'=>'Setting Updated Successfully!',
                'data'=>''
            ]);
        }

        $data = array();
        $data['setting'] = Setting::find(1);
        return view('front.contact_us',$data);
    }
    public function footer_contact_us(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $contact = Contact::where('email',$data['email'])->first();

            if(!empty($contact->id)) {
                $contact = Contact::find($contact->id);
            } else {
                $contact = new Contact();
            }
            
            $contact->email = $data['email'];
            $contact->name = $data['name'];
            $contact->status = 0;
            $contact->save();
            $setting = Setting::first();

            $message = new ContactMessage();
            $message->contact_id = $contact->id;
            $message->name = $data['name'];
            $message->save();

            $info = $contact;
            $template = EmailTemplate::find(14);
            $data = array();
            $patterns = array('{{message}}');
            $replacements = array($info->message);
            $data['email_body_text'] = str_replace($patterns,$replacements,$template->template);
            $data['subject'] = $template->subject;

            Mail::to($setting->email)->send(new SendMailable($data));
            $result = array(
                'success'=>true,
                'status'=>true,
                'message'=> 'Message Sent Successfully!',
            );

            return response()->json([
                "success" => true,
                'status'=>true,
                'message'=>'Setting Updated Successfully!',
                'data'=>''
            ]);
        }

        $data = array();
        $data['setting'] = Setting::find(1);
    }
    public function brand($slug=NULL)
    {
        $data = array();
        $data['slug'] = $slug;
        $data['blog_post'] = Post::where('slug',$slug)->first();
        $data['service'] = Brand::where('status',1)->get();
        return view('front.brand',$data);
    }


    public function product($slug=NULL,$brand=NULL)
    {
        $data = array();
        $data['slug'] = $slug;
        $sub_service = Post::where('slug',$slug)->first();
        $brand_id = Brand::where('slug',$brand)->first();
        if($sub_service->type == 'service') {
            $data['service'] = Post::where('status',1)->where('type','product')->where('brand_id',$brand_id->id)->where('service_id',$sub_service->id)->orderBy('id', 'desc')->get();
        } else {
            $data['service'] = Post::where('status',1)->where('type','product')->where('brand_id',$brand_id->id)->where('sub_service_id',$sub_service->id)->orderBy('id', 'desc')->get();
        }
        $data['blog_post'] = Post::where('slug',$slug)->first();
        return view('front.product',$data);
    }

    public function product_detail($slug=NULL)
    {
        $data = array();
        $data['slug'] = $slug;
        $data['product'] = Post::where('status',1)->where('slug',$slug)->with(['service','sub_service','brand','images','tags'])->first();

        $data['cart_val'] = 0;

        $cart = session()->get('cart');
        if(isset($cart[$data['product']->id])) {
            $data['cart_val'] = 1;
        }


        $data['sub_product'] = Post::where('status',1)->where('brand_id',$data['product']->brand_id)->where('id','!=' , $data['product']->id)->get();

        $data['hard_disk'] = PostExtra::where('post_id',$data['product']->id)->where('type','hard_disk')->get();
        $data['ram'] = PostExtra::where('post_id',$data['product']->id)->where('type','ram')->get();
        $data['warrenty'] = PostExtra::where('post_id',$data['product']->id)->where('type','warrenty')->get();
        $data['os'] = PostExtra::where('post_id',$data['product']->id)->where('type','os')->get();
        $data['product_in_cart'] = 0;
        $cart = session()->get('cart');
        if(isset($cart[$data['product']->id])) {
            $data['product_in_cart'] = 1;
        }

        // echo "<pre>"; print_r($data['product']->toArray()); die;
        return view('front.product_detail',$data);
    }

    public function checkout($slug=NULL)
    {
        $data = array();
        // $data['slug'] = $slug;
        // $data['product'] = Post::where('status',1)->where('slug',$slug)->first();

        $cart = session()->get('cart');

        $info = array();
        foreach($cart as $key => $val) {

            $info[$key]['product'] = Post::where('id',$val['id'])->first();
            $info[$key]['disk'] = PostExtra::where('id',$val['disk_id'])->first();
            $info[$key]['ram'] = PostExtra::where('id',$val['ram_id'])->first();
            $info[$key]['warrenty'] = PostExtra::where('id',$val['warrenty_id'])->first();
            $info[$key]['os'] = PostExtra::where('id',$val['os_id'])->first();
            $info[$key]['quantity'] = $val['quantity'];

        }

        $data['product_list'] = $info;


        return view('front.checkout',$data);
    }


    public function create_order(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            
            $order = new Order();
            $order->first_name = $data['first_name'];
            $order->last_name = $data['last_name'];
            $order->email = $data['email'];
            $order->address = $data['address'];
            $order->address_2 = $data['address_2'];
            $order->country = $data['country'];
            $order->state = $data['state'];
            $order->zip_code = $data['zip'];
            $order->uuid = Str::uuid();
            $order->save();

            $cart = session()->get('cart');

            $info = array();
            foreach($cart as $key => $val) {

                $item = new OrderItem();
                $item->product_id = $val['id'];
                $item->quantity = $val['quantity'];
                $item->disk_id = @$val['disk_id'];
                $item->ram_id = @$val['ram_id'];
                $item->warrenty_id = @$val['warrenty_id'];
                $item->os_id = @$val['os_id'];
                $item->order_id = $order->id;
                $item->save();

            }

            return response()->json([
                "success" => true,
                'status'=>true,
                'message'=>'Setting Updated Successfully!',
                'data'=>$order
            ]);
        }
    }

    public function complete_payment(Request $request)
    {

        if (!empty($_POST)) {
            $data  = $request->all();
            $order = Order::where('uuid', $data['reference_id'])->first();
            if($data['status'] == 'COMPLETED') {
                $order->payment_status = 2;
            } else {
                $order->payment_status = 3;
            }
            $order->transaction_id = $data['transaction_id'];
            $order->payment_response = $data['info'];
            $order->save();

            if($data['status'] == 'COMPLETED') {
                $setting = Setting::first();
                $template = EmailTemplate::find(16);
                $product = Post::where('id',$order->product_id)->first();
                $info = array();
                $patterns = array('{{name}}','{{transaction_id}}','{{payment_status}}');
                $replacements = array($order->first_name.' '.$order->last_name, $order->transaction_id, $data['status']);
                $info['email_body_text'] = str_replace($patterns,$replacements,$template->template);
                $info['subject'] = $template->subject;

                Mail::to($order->email)->send(new SendMailable($info));


                $info1 = array();
                $template1 = EmailTemplate::find(17);
                $patterns1 = array('{{name}}','{{transaction_id}}','{{payment_status}}', '{{address}}', '{{address_2}}', '{{county}}', '{{zip}}', '{{country}}');
                $replacements1 = array($order->first_name.' '.$order->last_name, $order->transaction_id, $data['status'], $order->address, $order->address_2,$order->state,$order->zip_code, $order->country);
                $info1['email_body_text'] = str_replace($patterns1,$replacements1,$template1->template);
                $info1['subject'] = $template1->subject;

                Mail::to('khalid@techlabz.uk')->send(new SendMailable($info1));

                $cart = session()->put('cart', []);

            }


            return response()->json([
                "success" => true,
                'status'=>true,
                'message'=>'Order Created Successfully!',
                'data'=>''
            ]);
        }
    }

    public function service($slug=NULL , $slug2=NULL)
    {

        if(!empty($slug)) {
            $data = array();
            $data['blog_post'] = Post::where('slug',$slug)->first();

            if($data['blog_post']->type == 'main_service') {
                $data['service'] = Post::where('status',1)->where('type','service')->where('service_id',$data['blog_post']->id)->get();
                return view('front.service',$data);
            } if($data['blog_post']->type == 'service' && ($data['blog_post']->slug == 'laptops' || $data['blog_post']->slug == 'pc' || $data['blog_post']->slug == 'laptop') ) {
                $data['service'] = Post::where('status',1)->where('type','sub_service')->where('service_id',$data['blog_post']->id)->get();
                return view('front.sub_service',$data);
            } else {
                $service = Post::where('slug','repair')->first();

                $data['repair_service'] = Post::where('status',1)->where('type','service')->where('id','!=',$data['blog_post']->id)->where('service_id',$service->id)->get();

                $data['brnd']= Brand::where('status',1)->get();

                return view('front.service_detail',$data);
            }

        } else {

            $data = array();
            $data['service'] = Post::where('status',1)->where('type','main_service')->get();
            return view('front.service',$data);

        }
        
    }


    public function sitemap()
    {
        $posts = Post::all();

        return response()->view('sitemap', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }

    public function service_contact_us(Request $request)
    {
        if (!empty($_POST)) {
            $data  = $request->all();
            $contact = RepairContact::where('email',$data['email'])->first();
            if(!empty($contact->id)) {
                $contact = RepairContact::find($contact->id);
            } else {
                $contact = new RepairContact();
            }
            $contact->email = $data['email'];
            $contact->name = $data['name'];
            $contact->message = $data['message'];
            $contact->status = 0;
            $contact->save();
            $setting = Setting::first();

            $message = new RepairContactMessage();
            $message->contact_id = $contact->id;
            $message->name = $data['name'];
            $message->message = $data['message'];
            $message->save();
            $this->send_email_test2($request->email,'Techlabz Support','front.email.customer_mail_template',$data);
            $info = $contact;
            // $template = EmailTemplate::find(14);
            // dump("template",$template);
            // $data = array();
            // dump("data",$data);

            // $patterns = array('{{message}}');
            // dump("patterns",$patterns);

            // $replacements = array($info->message);
            // dump("replacements",$replacements);
            // dd("test2");
            // dd($request->email);

            $junaid_email ="junaid.seodoors@gmail.com";
            $techlabz_email = "Hello@techlabz.com";
            $this->send_email_test1($junaid_email,$techlabz_email,'Techlabz Support','front.email.contact_template',$data);
            // $data['email_body_text'] = str_replace($patterns,$replacements,$template->template);
            // $data['subject'] = $template->subject;

            // Mail::to($setting->email)->send(new SendMailable($data));
            $result = array(
                'success'=>true,
                'status'=>true,
                'message'=> 'Message Sent Successfully!',
            );

            return response()->json([
                "success" => true,
                'status'=>true,
                'message'=>'Setting Updated Successfully!',
                'data'=>''
            ]);
        }

        $data = array();
        $data['setting'] = Setting::find(1);
        return view('front.contact_us',$data);
    }
    function send_email_test1($junaid_email,$techlabz_email,$subject,$template,$data)

    {

        Mail::send($template, ['data'=>$data], function($message) use ($subject, $junaid_email,$techlabz_email) {

                  $message->to($junaid_email,$subject)->subject($subject)
                  ->bcc($techlabz_email,$subject)->subject($subject);
                  $message->from('support@techlabz.uk',$subject);

           });

    }
    function send_email_test2($customer_email,$subject,$template,$data)

    {
        Mail::send($template, ['data'=>$data], function($message) use ($subject,$customer_email) {
                  $message->to($customer_email,$subject)->subject($subject)
                  ->from('support@techlabz.uk', $subject);
           });
    }
    public function cart()
    {
        $data = array();
        $cart = session()->get('cart');

        $info = array();
        if(!empty($cart)) {
            foreach($cart as $key => $val) {

                $info[$key]['product'] = Post::where('id',$val['id'])->first();
                $info[$key]['disk'] = PostExtra::where('id',$val['disk_id'])->first();
                $info[$key]['ram'] = PostExtra::where('id',$val['ram_id'])->first();
                $info[$key]['warrenty'] = PostExtra::where('id',$val['warrenty_id'])->first();
                $info[$key]['os'] = PostExtra::where('id',$val['os_id'])->first();
                $info[$key]['quantity'] = $val['quantity'];

            }
        }

        $data['product_list'] = $info;
        return view('front.cart',$data);
    }

    public function addToCart(Request $request)
    {

        if (!empty($_POST)) {
            $data  = $request->all();

            $cart = session()->get('cart', []);
    
            if(isset($cart[$data['id']])) {
                $cart[$data['id']]['quantity']++;
            } else {
                $cart[$data['id']] = [
                    "id" => $data['id'],
                    "quantity" => @$data['quantity'],
                    "disk_id" => @$data['disk_id'],
                    "ram_id" => @$data['ram_id'],
                    "warrenty_id" => @$data['warrenty_id'],
                    "os_id" => @$data['os_id'],
                ];
            }
            
            session()->put('cart', $cart);

            return response()->json([
                "success" => true,
                'status'=>true,
                'message'=>'Product added in cart Successfully!',
                'data'=>''
            ]);
        }
    }
  
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    //New Repair Services Design Work Start 


}
