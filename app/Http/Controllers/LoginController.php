<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
public function submit(Request $request){
// validate phone number
$request->validate([
'phone'=> 'required|numeric|min:10'
]);
// find or create phone number
$user=User::firstOrCreate([
'phone'=>$request->phone;
])
if(!$user){
    return response()->json(['msg'=>'could not process a user with that number '],401)
}
// send user one time use code
$user->notify();
}
}