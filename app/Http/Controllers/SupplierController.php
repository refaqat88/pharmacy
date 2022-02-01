<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('sadsadsa');
        $allusers = User::wherehas('kata', function ($q) {
            $q->where('type',2);
            $q->orderBy('id','Desc');
            $q->take('1');
        })->get();

       //$users = User::all();
        return view('admin.supplier.index', compact('allusers'));
       //return view('admin.katas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mobile(Request $request)
    {

        $previous_kata[] = 0;

        $user = User::where('phone',$request->mobile)->first();

        $previous_kata['remaining_amount']=0;
        $previous_kata['image'] = 'no-image.png';
       if ($user){
           $total_amount = Kata::where('user_id', $user->id)->orderBy('id', 'desc')->first();
           //dd($total_amount->remaining_amount);
           if ($total_amount != ''){
               $previous_kata['remaining_amount'] = $total_amount->remaining_amount;
               $previous_kata['name'] = $user->name;
               $previous_kata['page_no'] = $total_amount->page_no;
               $previous_kata['address'] = $total_amount->address;
               $previous_kata['image'] = $total_amount->image !=''?$total_amount->image:'no-image.png';
           }else{
               $previous_kata['name'] = $user->name;
               $previous_kata['page_no'] = $user->kata?$user->kata->page_no:'';
               $previous_kata['address'] = $user->kata?$user->kata->address:'';

           }
           //dd($previous_kata['remaining_amount']);
       }
        return response($previous_kata);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'address' => 'required',
            'mobile' => 'required|numeric',
            'page_no' => 'required|numeric',
            'remaining_amount' => 'required',
            /*'paid_amount' => 'required',*/
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
                    $input['type'] = 2;
                if ($request->hasFile('image')) {
                    $khata_image = $request->file('image');
                    $new_khata_image = "user" . time() . '.' . $khata_image->getClientOriginalExtension();
                    $khata_image->move(public_path('img/upload/khata'), $new_khata_image);
                    $input['image'] = $new_khata_image;

                }

                    $kata = Kata::create($input);
                //$user_id = $useradd->id;
            }else{
                $user_id =  $user->id;
                $input = $request->all();
                $input['receipt_no'] = $receipt;
                $input['current_date'] = date('Y-m-d');
                $input['user_id'] = $user_id;
                $input['type'] = 2;
                if ($request->hasFile('image')) {
                    $khata_image = $request->file('image');
                    $new_khata_image = "user" . time() . '.' . $khata_image->getClientOriginalExtension();
                    $khata_image->move(public_path('img/upload/khata'), $new_khata_image);
                    $input['image'] = $new_khata_image;

                }
                $kata = Kata::create($input);
            }


            return response()->json(['message' => 'Successfully Added!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function invoice(Request $request)
    {
        //dd($request->all());
        $user = User::wherehas('kata', function ($q) use($request){
            $q->orderBy('id','Desc');
            $q->take('1');
        })->where('id',$request->id)->first();
        $company = User::where('name','admin')->first();
        return view('admin.supplier.invoice',compact('user','company'));
    }

    public function show(Request $request)
    {
        //dd($request->all());
        $user = User::wherehas('kata', function ($q) use($request){
            $q->where('type','=',2);
            $q->orderBy('id','Desc');
            $q->take('1');
        })->where('id',$request->id)->first();

        //$user = User::findOrFail($request->id);
        $user->current_date = $user->kata? $user->kata->current_date:'';
        $user->receipt_no = $user->kata? $user->kata->receipt_no:'';
        $user->page = $user->kata? $user->kata->page_no:'';
        $user->address = $user->kata? $user->kata->address:'';
        $user->total_amount = $user->kata? $user->kata->total_amount:'';
        $user->paid_amount = $user->kata? $user->kata->paid_amount:'';
        $user->remaining_amount = $user->kata? $user->kata->remaining_amount:'';
        $user->paid_date = $user->kata? $user->kata->paid_date:'';
        $user->amount_status = $user->kata? $user->kata->amount_status:'';
        $user->image = $user->kata->image? $user->kata->image:'no-image.png';
        //$type =$user->kata? $user->kata->type:'';
        //$user->type = $type==0?'Temporary':'';
        return response($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::wherehas('kata', function ($q) use($request){
            $q->orderBy('id','Desc');
            $q->take('1');
        })->where('id',$request->id)->first();
        //$user = User::findOrFail($request->id);
        $user->kata_id = $user->kata? $user->kata->id:'';
        $user->current_date = $user->kata? $user->kata->current_date:'';
        $user->address = $user->kata? $user->kata->address:'';
        $user->total_amount = $user->kata? $user->kata->total_amount:'';
        $user->paid_amount = $user->kata? $user->kata->paid_amount:'';
        $user->remaining_amount = $user->kata? $user->kata->remaining_amount:'';
        $user->paid_date = $user->kata? $user->kata->paid_date:'';
        $user->amount_status = $user->kata? $user->kata->amount_status:'';
        $user->image = $user->kata->image? $user->kata->image:'no-image.png';
        $user->page = $user->kata? $user->kata->page_no:'';
        $type = $user->kata? $user->kata->type:'';
        $user->type = $type==3? 'Supplier':'';

        return response($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'address' => 'required',
            'mobile' => 'required|numeric',
            'page_no' => 'required|numeric',
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

           $data = [

               'address' => $request->address,
               'page_no' => $request->page_no,
               'current_date' => date('Y-m-d'),
               'total_amount' => $request->total_amount,
               'remaining_amount' => $request->remaining_amount,
               'paid_amount' => $request->paid_amount,
               'paid_date' => $request->paid_date,
               'amount_status' => $request->amount_status,
               'type' =>  2,
           ];

            if ($request->hasFile('image')) {
                $khata_image = $request->file('image');
                $new_khata_image = "user" . time() . '.' . $khata_image->getClientOriginalExtension();
                $khata_image->move(public_path('img/upload/khata'), $new_khata_image);
                $data['image'] = $new_khata_image;

            }

           $kata = Kata::where('id',$request->id)->update($data);

            return response()->json(['message' => 'Successfully updated!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

           Kata::where('id',$request->id)->delete();
           return response()->json(['message' => 'Successfully deleted!']);

    }
}
