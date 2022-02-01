<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use App\Models\PermanentKata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function invoice(Request $request)
    {
        //dd($request->all());
        $khata = Kata::wherehas('user', function ($q) use($request){
        })->where('id',$request->id)->first();
        //dd($khata);
        $company = User::where('name','admin')->first();
        return view('admin.reports.invoice',compact('khata','company'));
    }

   public function KhataReport(){
       return view('admin.reports.temporary-khata');
   }

   public function temporaryReportAjax(Request $request)
   {
       $array_re[] = '';
       $array_re = [
           'report_name' => 'required',
           'mobile' => 'required|numeric',
       ];
       if ($request->report_name == '0') {
           $array_re["report_type"] = "required";
       }
       if ($request->report_name == '1') {
           $array_re["from_date"] = "required";
           $array_re["to_date"] = "required";
       }

       $khata = User::where('phone',$request->mobile)->first();

       $validator = Validator::make($request->all(), $array_re);
       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()]);

       } else {
           $allkatas[] = '';

           ///dd($khata->);
           if ($request->report_name == 0) {

               if ($request->report_type == 'Daily') {
                   //dd($request->all());
                   $date = date('Y-m-d');

                   $allkatas = Kata::wherehas('user', function ($q) use ($date, $request) {
                       $q->where('phone', $request->mobile);
                   })->where('current_date', $date)->get();
                   //dd($allkatas);
                   //$data = Kata::where('current_date', $date)->where(mobile)->get();


               } else if ($request->report_type == 'Weekly') {
                   //
                   $now = Carbon::now();

                   $startOfWeek = $now->startOfWeek()->format('Y-m-d');

                   $endOfWeek = $now->endOfWeek()->format('Y-m-d');
                   //dd($endOfWeek);
                   $allkatas = Kata::wherehas('user', function ($q) use ($startOfWeek, $endOfWeek, $request) {
                       $q->where('phone', $request->mobile);
                   })->whereBetween('current_date', [$startOfWeek, $endOfWeek])->get();

                   //dd($allkatas);

               } else if ($request->report_type == 'Monthly') {
                   $now = Carbon::now();
                   $startOfMonth = $now->startOfMonth()->format('Y-m-d');

                   $endOfMonth = $now->endOfMonth()->format('Y-m-d');
                   //dd($endOfWeek);
                   $allkatas = Kata::wherehas('user', function ($q) use ($startOfMonth, $endOfMonth, $request) {
                       $q->where('phone', $request->mobile);
                   })->whereBetween('current_date', [$startOfMonth, $endOfMonth])->get();
               }

           } else if ($request->report_name == 1) {
               $from_date = $request->from_date;
               $to_date = $request->to_date;
               $allkatas = Kata::wherehas('user', function ($q) use ($from_date, $to_date, $request) {
                   $q->where('phone', $request->mobile);
               })->whereBetween('current_date', [$from_date, $to_date])->get();

           }

           return view('admin.reports.partials.temporary-khata-report', compact('allkatas','khata'))->render();

       }

   }
    public function permanentKhataReport(){
           return view('admin.reports.permanent-khata');
       }

   public function permanentReportAjax(Request $request){
       $array_re[] = '';
       $array_re =[
           'report_name' => 'required',
       ];
       if($request->report_name =='0'){
           $array_re["report_type"] = "required";
       }
       if($request->report_name == '1'){
           $array_re["from_date"] = "required";
           $array_re["to_date"] = "required";
       }

       $validator =   Validator::make($request->all(),$array_re);
       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()]);

       }else{
           $allkatas[] ='';
              if ($request->report_name ==0){

                if($request->report_type=='Daily'){
                    //dd($request->all());
                   $date = date('Y-m-d');

                    $allkatas = PermanentKata::wherehas('user', function ($q) use($date,$request){
                        $q->where('phone',$request->mobile);
                    })->where('current_date',$date)->get();
                    //dd($allkatas);
                   //$data = Kata::where('current_date', $date)->where(mobile)->get();


                }else if($request->report_type=='Weekly'){
                    //
                    $now = Carbon::now();

                    $startOfWeek = $now->startOfWeek()->format('Y-m-d');

                    $endOfWeek = $now->endOfWeek()->format('Y-m-d');
                    //dd($endOfWeek);
                    $allkatas = PermanentKata::wherehas('user', function ($q) use($startOfWeek,$endOfWeek,$request){
                        $q->where('phone',$request->mobile);
                    })->whereBetween('current_date',[$startOfWeek,$endOfWeek])->get();

                    //dd($allkatas);

                }else if($request->report_type=='Monthly'){
                    $now = Carbon::now();
                    $startOfMonth = $now->startOfMonth()->format('Y-m-d');

                    $endOfMonth = $now->endOfMonth()->format('Y-m-d');
                    //dd($endOfWeek);
                    $allkatas = PermanentKata::wherehas('user', function ($q) use($startOfMonth,$endOfMonth,$request){
                        $q->where('phone',$request->mobile);
                    })->whereBetween('current_date',[$startOfMonth,$endOfMonth])->get();
                }

              }else if($request->report_name ==1){
                $from_date = $request->from_date;
                $to_date = $request->to_date;
                  $allkatas = PermanentKata::wherehas('user', function ($q) use($from_date,$to_date,$request){
                      $q->where('phone',$request->mobile);
                  })->whereBetween('current_date',[$from_date,$to_date])->get();

              }

           return view('admin.reports.partials.permanent-khata-report', compact('allkatas'))->render();

        }


   }
}
