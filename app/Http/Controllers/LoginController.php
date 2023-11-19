<?php

namespace App\Http\Controllers;
use App\Notifications\LoginNeedVerification;
use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
public function submit(Request $request){
// validate phone number
$request->validate([
'phone'=> 'required|numeric|min:10'
]);
// find or create phone number
$user = User::firstOrCreate([
    'phone' => $request->phone
]);

if (!$user) {
    return response()->json(['msg' => 'could not process a user with that number'], 401);
}

// send user one time use code
$user->notify(new LoginNeedVerification());

return response()->json(['msg'=>'Text Message Notification Sent.']);

}
public function verify(Request $request){
// validate the incomming request
$request->validate([
    'phone' => 'required|numeric|min:10',
    'login_code' => 'required|numeric|between:111111,999999'
]);

// find user
$user=User::where('phone',$request->phone)->where('login_code',$request->login_code)->first();
// if the code provided the same one saved?
// if so, return auth token
if ($user){
    $user->update([
        'login-Ucode' => null,
    ]);
    return $user->createToken($request->login_code)->plainTextToken;
} else {
    return response()->json([
        'msg' => 'Invalid verification code.'
    ], 401);
}

// if not, return back a message
}
}