<?php

namespace App\Http\Controllers;

/*use App\Models\Image;
use App\Models\Kata;
*/


use App\Models\Kata;
use App\Models\Bill;
use App\Models\User;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$products = Product::where('admin_id',Auth::id())->get();
        return view('admin.bill.index');
    }
    public function search(Request $request)
    {
        //dd($request->all());
        $products = Product::where('admin_id',Auth::id())->where('prod_status','Active')->where('prod_name','like',$request->name . '%')->get();

        return response($products);
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

        //$previous_kata['remaining_amount']=0;
        //$previous_kata['image'] = 'no-image.png';
       if ($user){
           $total_amount = Kata::where(['admin_id' => Auth::id(),'user_id' => $user->id])->whereIn('type',[2])->orderBy('id', 'desc')->first();

           if ($total_amount != ''){
               $previous_kata['remaining_amount'] = $total_amount->remaining_amount;
               $previous_kata['name'] = $user->name;
               //$previous_kata['page_no'] = $total_amount->page_no;
               $previous_kata['address'] = $total_amount->address;
                //$previous_kata['type'] = $total_amount->type;
               /* $previous_kata['image'] = $total_amount->image !=''?$total_amount->image:'no-image.png';*/
           }else{
               $previous_kata['name'] = $user->name;
               //$previous_kata['page_no'] = $user->kata?$user->kata->page_no:'';
               $previous_kata['address'] = $user->kata?$user->kata->address:'';
               //$previous_kata['type'] = $total_amount->type;

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

        $input = $request->all();
        //dd($input);
        $validator = Validator::make($request->all(), [
            'mobile' =>'required|numeric',
            'name' =>'required',
            'address' =>'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else {

            $user = User::where('phone', $request->mobile)->first();
            $remaining = 0;
            $remaining = $user->kata? $user->kata->remaining_amount:0;
            //dd($remaining);
            $receipt = Kata::select('receipt_no')->orderBy('receipt_no', 'Desc')->first();

            if ($receipt) {
                $receipt = $receipt->receipt_no + 1;
            } else {
                $receipt = 1000;
            }
            //dd($user->kata);
            if (!$user) {
                $data = [
                    'name' => $request->name,
                    'phone' => $request->mobile,
                    'username' => $request->mobile,
                    'password' => hash::Make($request->mobile),
                    'status' => 'Active',
                ];
                $user = User::create($data);
            }

            $i=0;
            foreach ($request->product_name as $key => $value) {
                        $product = (object)[];

                        $product->id =$request->product_id[$i];

                        if (empty($request->product_id[$i])){
                            $product = new Product();
                            $product->prod_name = $request->product_name[$i];
                            $product->packet_per_box = $request->packet_per_box[$i];
                            $product->item_per_packet = $request->item_per_packet[$i];
                            $product->item_price_supplier = $request->item_unit_price[$i];
                            //$product->item_price_retail = $request->item_price_retailer[$i];
                            $product->prod_status = 'Active';
                            $product->date = date('Y-m-d');
                            $product->admin_id = Auth::id();
                            $product->save();
                        }

                        $bill = new Bill();
                        $bill->user_id = $user->id;
                        $bill->product_id = $product->id;
                        $bill->quantity = $request->item_quantity[$i];
                        $bill->packet_per_box = $request->packet_per_box[$i];
                        $bill->item_per_packet = $request->item_per_packet[$i];
                        $bill->item_price_supplier = $request->item_unit_price[$i];
                        $bill->total_price = $request->item_price[$i];
                        $bill->date = date('Y-m-d');
                        $bill->admin_id = Auth::id();
                        $bill->save();

                        $i++;
                    }

                    $kata = new Kata();
                    $kata->user_id =  $user->id;
                    $kata->receipt_no = $receipt;
                    $kata->address = $request->address;
                    $kata->total_amount = $request->total_price + $remaining;
                    $kata->remaining_amount = $request->total_price + $remaining;
                    $kata->paid_amount = 0;
                    $kata->current_date = date('Y-m-d');
                    $kata->paid_date = date('Y-m-d');
                    $kata->amount_status = "Bill";
                    $kata->admin_id = Auth::id();
                    $kata->type = 2;


                    $kata->save();
            }

            return response()->json(['message' => 'Successfully Added!']);

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
        return view('admin.katas.invoice',compact('user','company'));
    }

    public function show(Request $request)
    {
        $product = Product::where('id',$request->id)->where('admin_id', Auth::id())->first();
        return response($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product = Product::where('id',$request->id)->where('admin_id', Auth::id())->first();

        return response($product);
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
        $validator = Validator::make($request->all(), [
            'product_name' =>'required',
            'packet_per_box' => 'required|numeric',
            'item_per_packet' => 'required|numeric',
            'item_price_supplier' => 'required|numeric',
            'item_price_retailer' => 'required|numeric',
            //'product_status' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else {

           $data = [

                'prod_name' => $request->product_name,
                'packet_per_box' => $request->packet_per_box,
                'item_per_packet' => $request->item_per_packet,
                'item_price_supplier' => $request->item_price_supplier,
                'item_price_retail' => $request->item_price_retailer,
                'prod_status' => $request->product_status=='Inactive'?'Inactive':'Active',
                'date' => date('Y-m-d'),
                'admin_id' => Auth::id(),
           ];


            Product::where('id',$request->id)->update($data);

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

           Product::where('id',$request->id)->delete();
           return response()->json(['message' => 'Successfully deleted!']);

    }
}
