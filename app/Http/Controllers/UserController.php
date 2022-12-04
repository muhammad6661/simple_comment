<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function signUp()
    {
        return view('front.user.sing_up');
    }
    public function signIn()
    {
        return view('front.user.sign_in');
    }
    public function myProfile()
    {
        return view('front.user.profile');
    }
    public function uploadAvatar(Request $request)
    {
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name = time() . '_' . uniqid(64) . '.png';
        $path = public_path() . "/uploads/users/" . $image_name;
        file_put_contents($path, $data);
        $user = User::find(Auth::user()->id);
        if ($user->avatar != "") {
            if (file_exists('/public/uploads/users/' . $user->avatar)) {
                unlink('/public/uploads/users/' . $user->avatar);
            }
        }
        $user->avatar = $image_name;
        $user->save();
        return response()->json(['status' => 1, 'img' => $image_name, 'message' => "Image uploaded successfully"]);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'login' => 'required|unique:users,login,' . Auth::user()->id . ',id',
        ]);
        $user = User::find(Auth::user()->id);
        $user->update($request->all());
        return redirect()->back()->with(['success_message' => 'Profile updated!']);
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (is_null($request->get('new_password')) || $request->verify_password != $request->get('new_password')) {
            return response()->json(['status' => 0, 'message' => 'New password & verify passwrd mismatch!'], 200);
        }
        if (!Hash::check($request->get('old_password'), $user->password)) {
            return response()->json(['status' => 0, 'message' => 'Current password  mismatch!'], 200);
        }
        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        return response()->json(['status' => 1], 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
    public function loginUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'login' => 'required',
                'password' => 'required',
            ]
        );
        $user = User::where('login', $request->get('login'))->first();
        if (!empty($user)) {
            if (Hash::check($request->get('password'), $user->password)) {
                Auth::loginUsingId($user->id, true);
                return redirect('/');
            }
        }
        return redirect()->back()->withErrors(['_message' => ' Invalid login or password.']);
    }

    public function registerUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'surname' => 'required',
                'login' => 'required|unique:users,login,' . $request->get('login'),
                'password' => 'required|min:6',
                'confirm_password' => 'same:password',
            ],
        );
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        Auth::loginUsingId($user->id, true);
        return redirect('/');
    }
}
