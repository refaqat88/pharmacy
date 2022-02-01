<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Hash;
use File;

class UserController extends Controller
{



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

    public function Logout()
    {
        session()->flush();
        return Redirect('login');
    }
}
