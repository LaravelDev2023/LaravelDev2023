<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Events\WelcomeEmail;
use function Illuminate\Events\queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgatePasswordEmail;

class AdminController extends Controller
{
    //

    public function index(){
        return view('admin.index');
    }

    public function allUserList(Request $request){
        $all_user = User::all();
        return view('admin.all_user_list',compact('all_user'));
    }
    
    public function editUserData(Request $request, $id){
         $user  = User::find($id);
         $countries = Countries::all();
         
         return view('admin.update_user_profile',compact('user','countries'));
    }
    
    public function updateUserByAdmin(Request $request, $id){
        $this->validate($request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:10|string',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'role_id' => 'required|in:0,1',
            'adderess' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
        ]);
        $req=$request->except(['_token', 'regist']);   
        $user=User::find($id);
        $user->update($req);
        return redirect()->route('all_user');
    }

    public function updateUserImageByAdmin(Request $request, $id){
        $this->validate($request,[
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $imageName = 'lv'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imageName);
        $req['profile'] = $imageName;
        $user=User::find($id);
        $user->update($req);
        return redirect()->route('all_user');
    }

    public function addUserByAdmin(){
       $countries = Countries::all();
       return view('admin.add_user_by_admin',compact('countries'));
    }

    public function addUserDataByAdmin(Request $request){
        $data = $request->all();
      
        $this->validate($request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:10|string',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'adderess' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png',
            'role_id' => 'required'
        ]);
        $req=$request->except(['_token', 'regist']);
        $imageName = 'lv'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imageName);
        $req['profile'] = $imageName;
        $req['password'] = Hash::make($request->password);
        $requestData = User::create($req);
        
        event(new WelcomeEmail($requestData));
        return redirect()->route('all_user');
    }

    public function deactivateUserByAdmin(Request $request, $id, $status='1'){
        $data = $request->all();
        //echo"<pre>";print_r($status); exit;
        $user=User::find($id);
        if(!empty($user)){
            $user->is_active = $request->status;
            $user->save();
            return redirect()->route('all_user')->with('success' ,'Status Updated Successfully');
        }
    }
}
