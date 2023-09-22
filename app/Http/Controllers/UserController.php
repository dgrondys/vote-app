<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class UserController extends Controller
{
    //
    public function index()
    {
        if(Auth::check()){
            return view('profile');
        }
        else{
            return redirect()->route('login');
        }
        
    }
    public function updateAvatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            return redirect('profile');
        }
        return view('profile');
    }
    public function deleteAvatar(Request $request)
    {
        $user = Auth::user();
        if($user){
            $user->avatar = 'default.png';
            $user->save();
            return redirect()->route('profile');
        }
    }
    
    public function deleteUser()
    {
        $user = User::find(Auth::user()->id);
        Auth::logout();
        $user->comments()->delete();
        $user->votes1()->delete();
        $user->ideas()->delete();
        $user->delete();
        return redirect()->route('idea.index');
    }
}
