<?php
 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller{
    
    public function register(){
        return view('register');
    }

    public function registerPost(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
    
        $error = '';
    
        if(empty($name)){
            $error = 'Name cannot be blank.';
        }
        elseif(empty($email)){
            $error= 'Email cannot be blank.';
        } 
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = 'Email format is invalid.';
        } 
        elseif(User::where('email', $email)->exists()){
            $error = 'Email is already taken.';
        }
        elseif(empty($password)){
            $error = 'Password cannot be blank.';
        } 
        elseif(strlen($password) < 8){
            $error = 'Password must be at least 8 characters long.';
        }
    
        if(!empty($error)){
            return back()->with('error', $error)->withInput();
        }
    
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
    
        return back()->with('success', 'Account created successfully!');
    }

    public function login(){
        return view('login');
    }
    
    public function loginPost(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
    
        $error = '';

        if(empty($email)){
            $error= 'Email cannot be blank.';
        } 
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = 'Email format is invalid.';
        } 
        elseif(empty($password)){
            $error = 'Password cannot be blank.';
        } 
        elseif(strlen($password) < 8){
            $error = 'Password must be at least 8 characters long.';
        }
    
        if(!empty($error)){
            return back()->with('error', $error)->withInput();
        }
    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if(Auth::attempt($credentials)){
            return redirect('/')->with('success', 'Account login success!');
        }
    
        return back()->with('error', 'Email and password did not match!');
    }

}