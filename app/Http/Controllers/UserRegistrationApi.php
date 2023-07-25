<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Events\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserRegistrationApi extends Controller
{
   public function addUserByApi(Request $request): JsonResponse
   {
    try{
    $req=$request->except(['_token', 'regist']);
        $imageName = 'lv'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imageName);
        $req['profile'] = $imageName;
        $req['password'] = Hash::make($request->password);
        $req['role_id'] = User::USER_ROLE;
        $requestData = User::create($req);
        event(new WelcomeEmail($requestData));
        return response()->json(['status'=>200, 'message' => 'Data Inserted Successfully', 'data' => $requestData]);
    }catch(\Exception $ex){
        return response()->json(['status'=>500, 'message' => $ex->getMessage(),'data' => null]);
    }
   }
}
