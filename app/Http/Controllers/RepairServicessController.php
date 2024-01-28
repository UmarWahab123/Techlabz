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
use App\Models\RepairServiceCategory;

class RepairServicessController extends Controller
{
    public function repair_services(){
        $data['repair_services'] = RepairServiceCategory::get()->unique('sub_service_id');
        return view('front.repair_services',compact('data'));
    }
    public function repair_services_category($type) {
        $single_repair_services_category = RepairServiceCategory::where('type', $type)->first();
        $data['total_repair_services_category'] = RepairServiceCategory::where('type', $type)->get();
        return view('front.repair_services_category', compact('data', 'single_repair_services_category'));
    }  

    public function repair_services_cat_details($type,$slug,$id){
        $repair_services_cat_details = RepairServiceCategory::where('id', $id)->where('type', $type)->first();
        return view('front.repair_services_cat_sub_category', compact('repair_services_cat_details'));
    }

}
