<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $data['temporarykhata'] = Kata::where('admin_id', Auth::id())->where('type', 0)->whereIn('amount_status',['Bill','Paid'])->sum('total_amount');
        //dd($data['temporarykhata']);
        $data['temporary_revenue'] = Kata::where('admin_id', Auth::id())->where('type', 0)->whereIn('amount_status',['Bill','Paid'])->sum('paid_amount');
        //dd($data['temporary_revenue']);
        $data['temporary'] = (int)$data['temporarykhata'] - (int)$data['temporary_revenue'];

        $data['permanentkhata'] = Kata::where('admin_id', Auth::id())->where('type', 1)->whereIn('amount_status',['Bill','Paid'])->sum('total_amount');
        $data['permanent_revenue'] = Kata::where('admin_id', Auth::id())->where('type', 1)->whereIn('amount_status',['Bill','Paid'])->sum('paid_amount');
        $data['permanent'] =  (int)$data['permanentkhata'] - (int)$data['permanent_revenue'];

        $data['supplierKhata'] = Kata::where('admin_id', Auth::id())->whereIn('type', [2])->whereIn('amount_status',['Bill','Paid'])->sum('total_amount');
        $data['revenue'] = Kata::where('admin_id', Auth::id())->where('type', 2)->whereIn('amount_status',['Bill','Paid'])->sum('paid_amount');
        //dd($data['supplierKhata']);
        $data['expenses'] = (int)$data['supplierKhata'] - (int)$data['revenue'];
        return view('admin.home',compact('data'));
    }
}
