<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserTokenResource;
use App\Models\Survey;
use App\Models\User;
use http\Env\Response;
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

        if ($validator->fails()) {
            return \response('Error', 422);
        }

        $request['password'] = Hash::make($request['password']);
        $user = User::query()->create($request->toArray());
        return new UserResource($user);

//        return new UserTokenResource($user);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);
        if ($validator->fails()) {
            return response('Ошибка', 401);
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

    public function change(Request $request)
    {
        if ($request->email != "" and $request->name != "") {
            User::query()->find(Auth::user()->id)->update(['email' => $request->email, 'telegram' => $request->telegram]);
            Survey::query()->where('device_id', $request->device_id)->update(['name' => $request->name]);
        }
        return new UserResource(Auth::user());
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:4',
        ]);
        if ($validator->fails()) {
            return \response('Error' . $request->password, 422);
        }
        $request['password'] = Hash::make($request['password']);
        User::query()->find(Auth::user()->id)->update(['password' => $request['password']]);

        return new UserResource(Auth::user());
    }

}
