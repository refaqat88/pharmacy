<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Hash;
use File;
use Redirect,Response;
use DB;
use Illuminate\Support\Arr;

class UserController extends Controller
{


    public function index(){
        $users = User::whereHas('roles', function ($q) {
            $q->where('name' , 'admin');
        })->orderBy('id','desc')->get();

        //dd($roles);
        return view('admin.users.index', compact('users'));
    }

    public function loginView(){
        if (auth()->check()) {
            return redirect()->to('/home');
        }
        return view('login');
    }


    Public function login(Request $request){

        $request->validate([
            'username'    => 'required',
            'password' => 'required'
        ]);

        $username = $request->get('username');
        $password = $request->get('password');





        if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'Active'])) {
            //dd(Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'Active']));
            /*$role = auth()->user()->roles->first();

            if (!$role->isEmpty()){
                if($role->name=='Super Admin'){

                    return  redirect('/admin/home');
                    exit;

                }
            }*/


            //app()->setlocale($language); //echo  $language;exit;
            //session()->put('locale', $language);

            return  redirect('/home');


        }else{
            $request->flashExcept('password');
            return back()->with('error', 'User is not found or Account is not active');
        }
    }

    public function editProfile(){
        $user = User::where('id',  Auth::user()->id)->first();
        return view('admin.edit-profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        //dd($request->all());
        $user = User::where('id',  Auth::user()->id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'phone'    => 'required',
            'email'    => 'required',
            'company'    => 'required',
            'address'    => 'required',
            'password' => 'confirmed',

        ]);

        if ($validator->fails()) {
            return redirect('edit-profile')
                ->withInput()
                ->withErrors($validator);
        }else {

            $form_data = array(
                'username' => $request->username,
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'company'    => $request->company,
                'address'    => $request->address,

            );
            if ($request->password !='' && $request->password_confirmation !='' && $request->password ==$request->password_confirmation){
                $form_data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('user_image')) {
                if(File::exists(public_path('img/upload/logo/'.$user->user_image))){
                    File::delete(public_path('img/upload/logo/'.$user->user_image));
                }
                $user_image = $request->file('user_image');
                $new_user_image = "logo" . time() . '.' . $user_image->getClientOriginalExtension();
                $user_image->move(public_path('img/upload/logo'), $new_user_image);
                $form_data['user_image'] = $new_user_image;
            }
            //dd($form_data);


            User::where('id', Auth::user()->id)->update($form_data);
            $request->flash();
            return redirect()->back()->withSuccess('Successfully Updated!');

        }

    }


    public function ShowUser($id)
    {

        $where = array('id' => $id);
        $user = User::where($where)->first();
        $user->type = $user->roles->pluck('name','name')->first();
        //dd($user->type);
        return Response::json($user);

    }

    public function EditUser($id)
    {

        $user = User::findOrFail($id);
        $user->user_type = $user->roles->pluck('id')->first();

        return Response::json($user);
    }

    public function CreateUser(Request $request)
    {

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'password_confirmation' => 'same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else{

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['status'] = ($request->get('status'))? 'Active' : 'Inactive';
            $input['admin_id'] = '';
            $user = User::create($input);
            $user->assignRole('admin');
            return response()->json(['message' => 'Successfully Added!']);
        }



    }

    public function UpdateUser(Request $request)
    {
        //dd($request->all());
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password_confirmation' => 'same:password',
        ]);



        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()]);

        }else {


            $input = $request->all();

            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }

            if(!empty($input['status'])){
                $input['status'] = 'Active';
            }else{
                $input['status'] = 'Inactive';
            }

            $user = User::find($id);

            $user->update($input);

            DB::table('model_has_roles')->where('model_id',$id)->delete();

            $user->assignRole('admin');

            return response()->json(['message' => 'Successfully Updated!']);
        }


        //dd($form_data);



        //return redirect()->back()->with('message', 'Successfully Updated!');

    }

    public function ResetUserPaassword(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        //dd($user->username);
        $form_data = array();

        $form_data = array(
            'password'      => Hash::make($user->username)
        );

        //dd($form_data);
        User::where('id',  $request->id)->update($form_data);
        $request->flash();
        return redirect()->back()->with('message', 'Successfully Updated!');

    }

    public function Logout()
    {
        session()->flush();
        return Redirect('login');
    }
}
