<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'hasło' => ['required', new MatchOldPassword],
            'nowe_hasło' => ['required', 'confirmed', 'min:8'],
            'nowe_hasło_confirmation',
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->nowe_hasło)]); 
        return view('profile');
        return redirect()->route('profile');
    }
}
