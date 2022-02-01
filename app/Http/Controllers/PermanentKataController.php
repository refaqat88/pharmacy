<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class PermanentKataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permanent_allusers = User::wherehas('kata', function ($q) {
            $q->where('type',1);
            $q->orderBy('id','desc');
            $q->take('1');
        })->get();

        //dd($query);
        //$users = User::all();
        return view('admin.permanent-katas.index', compact('permanent_allusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function mobile(Request $request)
    {
        $user = User::where('phone',$request->mobile)->first();

        $previous_kata['remaining_amount']=0;
        if ($user){
            $total_amount = Kata::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            //dd($total_amount->remaining_amount);
            if ($total_amount != ''){
                $previous_kata['remaining_amount'] = $total_amount->remaining_amount;
            }

            //dd($previous_kata['remaining_amount']);
        }
        return response($previous_kata);
    }


    public function invoice(Request $request)
    {
        //dd($request->all());
        $user = User::wherehas('kata', function ($q) use($request){
            $q->orderBy('id','Desc');
            $q->take('1');
        })->where('id',$request->id)->first();
        $company = User::where('name','admin')->first();
        return view('admin.permanent-katas.invoice',compact('user','company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'address' => 'required',
            'mobile' => 'required|numeric',
           /* 'current_date' => 'required',*/
            'remaining_amount' => 'required',
           /* 'paid_amount' => 'required',*/
            'paid_date' => 'required',
            'amount_status' => 'required',
        ],[
            'name.required' => 'The name is required',
            'name.regex' => 'The name only contain alphabets',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $user = User::where('phone', $request->mobile)->first();
            $receipt = Kata::select('receipt_no')->orderBy('receipt_no','Desc')->first();

            if ($receipt){
                $receipt = $receipt->receipt_no + 1;
            }else{
                $receipt = 1000;
            }
            if(!$user){
                $data = [
                    'name' => $request->name,
                    'phone' => $request->mobile,
                    'username' => $request->mobile,
                    'password' => hash::Make($request->mobile),
                    'status' => 'Active',
                ];

                $useradd = User::create($data);
                $input = $request->all();
                $input['receipt_no'] = $receipt;
                $input['current_date'] = date('Y-m-d');
                $input['user_id'] = $useradd->id;
                $input['type'] = 1;
                $kata = Kata::create($input);
                //$user_id = $useradd->id;
            }else{
                $user_id =  $user->id;
                $input = $request->all();
                $input['receipt_no'] = $receipt;
                $input['current_date'] = date('Y-m-d');
                $input['user_id'] = $user_id;
                $input['type'] = 1;

                $kata = Kata::create($input);
            }


            return response()->json(['message' => 'Successfully Added!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PermanentKata  $permanentKata
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = User::wherehas('kata', function ($q) use($request){
            $q->where('type',1);
            $q->orderBy('id','Desc');
            $q->take('1');
        })->where('id',$request->id)->first();
        //$user = User::findOrFail($request->id);
        $user->current_date = $user->kata? $user->kata->current_date:'';
        $user->address = $user->kata? $user->kata->address:'';
        $user->receipt_no = $user->kata? $user->kata->receipt_no:'';
        $user->total_amount = $user->kata? $user->kata->total_amount:'';
        $user->paid_amount = $user->kata? $user->kata->paid_amount:'';
        $user->remaining_amount = $user->kata? $user->kata->remaining_amount:'';
        $user->paid_date = $user->kata? $user->kata->paid_date:'';
        $user->amount_status = $user->kata? $user->kata->amount_status:'';
        $type =$user->kata? $user->kata->type:'';
        $user->type = $type==1?'Permanent':'';
        /*$kata = Kata::findOrFail($request->id);
        $kata->name = $kata->user?$kata->user->name:'';
        $kata->phone = $kata->user?$kata->user->phone:'';*/
        return response($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermanentKata  $permanentKata
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::wherehas('kata', function ($q) use($request){
            $q->where('type',1);
            $q->orderBy('id','Desc');
            $q->take('1');
        })->where('id',$request->id)->first();
        //$user = User::findOrFail($request->id);
        $user->permanent_kata_id = $user->kata? $user->kata->id:'';
        $user->current_date = $user->kata? $user->kata->current_date:'';
        $user->address = $user->kata? $user->kata->address:'';
        $user->total_amount = $user->kata? $user->kata->total_amount:'';
        $user->paid_amount = $user->kata? $user->kata->paid_amount:'';
        $user->remaining_amount = $user->kata? $user->kata->remaining_amount:'';
        $user->paid_date = $user->kata? $user->kata->paid_date:'';
        $user->amount_status = $user->kata? $user->kata->amount_status:'';


        /*$kata = Kata::findOrFail($request->id);
        $kata->name = $kata->user?$kata->user->name:'';
        $kata->phone = $kata->user?$kata->user->phone:'';*/
        return response($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermanentKata  $permanentKata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'address' => 'required',
            'mobile' => 'required|numeric',
            /*'current_date' => 'required',*/
            /*'total_amount' => 'required',*/
            'remaining_amount' => 'required',
          /*  'paid_amount' => 'required',*/
            'paid_date' => 'required',
            'amount_status' => 'required',
        ],[
            'name.required' => 'The name is required',
            'name.regex' => 'The name only contain alphabets',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $User_data = [
                'name' => $request->name,
                'phone' => $request->mobile,
                'status' => 'Active',
            ];

            User::where('id',$request->user_id)->update($User_data);

            //$useradd = User::create($data);
            //$user = User::where('phone', $request->user_id)->first();
            $data = [

                'address' => $request->address,
                'current_date' => date('Y-m-d'),
                'total_amount' => $request->total_amount,
                'remaining_amount' => $request->remaining_amount,
                'paid_amount' => $request->paid_amount,
                'paid_date' => $request->paid_date,
                'amount_status' => $request->amount_status,
                'type' => 1,
            ];

            $kata = Kata::where('id',$request->id)->update($data);

            return response()->json(['message' => 'Successfully updated!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermanentKata  $permanentKata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Kata::where('id',$request->id)->delete();
        return response()->json(['message' => 'Successfully deleted!']);
    }
}
