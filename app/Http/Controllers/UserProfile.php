<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Controller
{
    //
    public function UserProfile(Request $request){
        $user = auth()->user();
        $countries = Countries::all();
        return view('userprofile',compact('user','countries'));
    }
    public function UserProfileUpdate(Request $request){
        $this->validate($request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:10|string',
            'email' => 'required|email|unique:users,email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'adderess' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
        ]);
        $req=$request->except(['_token', 'regist']);
        $user=User::find(auth()->user()->id);
        $user->update($req);
        return redirect()->route('user_profile');
        
    }

    public function updateUserImage(Request $request){
        $this->validate($request,[
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $imageName = 'lv'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imageName);
        $req['profile'] = $imageName;
        $user=User::find(auth()->user()->id);
        $user->update($req);
        return redirect()->route('user_profile');
    }
}
