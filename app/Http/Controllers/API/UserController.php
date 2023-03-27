<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function register(Request $request){

    $validate = validator::make($request->all(), [
        'name'=>'required|min:2|max:100|string',
        'email'=>'required|min:4|string|email|unique:users',
        'password'=>'required|string|min:6|confirmed',
    ]);

    if($validate->fails()){
        return response()->json($validate->errors());
    }

    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
    ]);

    return response()->json([
        'msg'=>'User Inserted Successfully',
        'user'=>$user
    ]);
  }
}
