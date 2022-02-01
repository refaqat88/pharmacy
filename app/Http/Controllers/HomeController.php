<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $data['temporarykhata'] = Kata::where('type', 0)->where('amount_status','Bill')->sum('total_amount');

        $data['temporary_revenue'] = Kata::where('type', 0)->where('amount_status','Bill')->sum('paid_amount');
        $data['temporary'] = (int)$data['temporarykhata'] - (int)$data['temporary_revenue'];

        $data['permanentkhata'] = Kata::where('type', 1)->where('amount_status','Bill')->sum('total_amount');
        $data['permanent_revenue'] = Kata::where('type', 1)->where('amount_status','Bill')->sum('paid_amount');
        $data['permanent'] =  (int)$data['permanentkhata'] - (int)$data['permanent_revenue'];
        $data['supplierKhata'] = Kata::where('type', 2)->where('amount_status','Bill')->sum('total_amount');
        $data['revenue'] = Kata::where('type', 2)->where('amount_status','Bill')->sum('paid_amount');
        $data['expenses'] = (int)$data['supplierKhata'] - (int)$data['revenue'];
        return view('admin.home',compact('data'));
    }
}
