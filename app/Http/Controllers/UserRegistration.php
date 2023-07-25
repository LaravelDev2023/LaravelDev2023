<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\WelcomeEmail;
use App\Models\Countries;
use App\Models\PasswordReset;
use App\Models\User;
use function Illuminate\Events\queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgatePasswordEmail;

class UserRegistration extends Controller
{
    //
    public function UserRegistration(){
        $countries = Countries::all();
        return view('user_registration',compact('countries'));
    }
    public function UserRegistrationForm(Request $request){
        $this->validate($request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:10|string',
            'email' => 'required|email|unique:users,email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'adderess' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png'
        ]);
        $req=$request->except(['_token', 'regist']);
        $imageName = 'lv'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imageName);
        $req['profile'] = $imageName;
        $req['password'] = Hash::make($request->password);
        $req['role_id'] = User::USER_ROLE;
        $requestData = User::create($req);
        
        event(new WelcomeEmail($requestData));
        return redirect()->route('home')->with('success','Registration successfully!');
        
    }
    public function UserLogin(){
        return view('user_login');
    }
    public function UserLoginForm(Request $request){
        $logindata = $request->except(['_token','loginbtn'] );
        if(Auth::attempt($logindata)){
            if(auth()->user()->role_id == User::ADMIN_ROLE){
                return redirect()->route('admin_home');
            }else{
                return redirect()->route('home');
            }
            //$user = auth()->user();
            return redirect()->intended('/')->withSuccess('Sucessfulyy login');
           
        } else{
            return redirect()->intended('login')->withSuccess('Sucessfulyy login');
        }
    }

    public function UserLogout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');

    }
    public function UserResetPassword(){
        return view('resetpassword');
    }
    public function UserResetPasswordForm(Request $request){
        $this->validate($request,[
           
            'email' => 'required|email|exists:users,email',
           
        ]);
        $requestData= $request->except(['_token','submit']);
        $requestData['token'] = Str::random('30');
        $forgatePasswordDate = DB::table('password_resets')->insert($requestData);
        Mail::to($requestData['email'])->send(new SendForgatePasswordEmail($requestData));
        
    }

    public function resetPassword(Request $request, $token){ 
       $email = $request->email;
       $checkdata = DB::table('password_resets')->where('email', $request->email)->where('token',$token)->count();
       if($checkdata>0){
        return view('reset-password-data',compact('email'));
       }else{
        return redirect()->route('home')->with('success','Invalid email adderess');
       }
       
    }

    public function resetPasswordData(Request $request){
        $this->validate($request,[
           
            'resetpass' => 'required|min:6',
            'cnfirm_resetpassl' => 'required|same:resetpass',
           
        ]);

        User::where('email',$request->email)->update(['password'=>bcrypt($request->resetpass)]);
        return redirect()->route('login')->with('success','Password reset successfully');

    }
}

