<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show registration page
    public function showRegister(){
        return view('auth.register');
    }

    public function registerUser(Request $request){
        $request->validate([
            'fname'=>'required|string|max:20',
            'lname'=> 'required|string|max:20',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name'=>$request->fname . ' '. $request->lname,
            // 'lname'=>$request->lname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        Auth::login($user);
    //      if($request->ajax()) {
    //     return response()->json(['success'=>true]);
    // }
    return response()->json(['success' => true]);

        return redirect('/home_page/dashboard');
    }

    // Login
    public function showLogin(){
        return view('auth.login');
    }
    
    public function logUserIn(Request $request){
        $credentials = $request->validate([
            // 'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return response()->json([
                'success'=>true,
                'message'=> 'User Logged In Successfully!',
                'redirect'=>'home_page/dashboard'
            ]);
        }
        return response()->json([
            'success'=>false,
            'errors'=>[
                'email'=> ['Invalid credentials']
            ]
        ],422);

        // return back()->withErrors([
        //     'email'=> 'Invalid credentials',
        // ]);
    }

    // Logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if($request->ajax()){
            return response()->json([
                'success'=> true,
                'message'=>"Logged out successfully!"
            ]);
        }

        return redirect('auth/login');
    }

}
