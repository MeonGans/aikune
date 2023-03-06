<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserTokenResource;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:4',
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $request['password'] = Hash::make($request['password']);
        $user = User::query()->create($request->toArray());
        return new UserResource($user);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);
        if ($validator->fails())
        {
            return $validator->errors();
        }
        $user = User::query()->where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return new UserTokenResource($user);
            } else {
                return response('problem with pass', 401);
            }
        } else {
            return response('problem with mail', 401);
        }
    }

    public function user()
    {
        return new UserResource(Auth::user());
    }

//    public function change(Request $request)
//    {
//        if ($request->email != "") {
//            User::query()->find(Auth::user()->id)->update(['email' => $request->email]);
//        }
//        if (Hash::check($request->old_password, Auth::user()->password)) {
//            if ($request->new_password == $request->re_password) {
//                User::query()->find(Auth::user()->id)->update(['password' => $request->new_password]);
//            }
//        }
//        $request['password'] = Hash::make($request['password']);
//        return new UserResource(Auth::user());
//    }

}
