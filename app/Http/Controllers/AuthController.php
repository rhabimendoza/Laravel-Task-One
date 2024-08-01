<?php
 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller{
    
    public function register(){
        return view('register');
    }
 
    public function login(){
        return view('login');
    }


    public function registerPost(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
    
        $errors = [];
    
        if (empty($name)) {
            $errors[] = 'Name cannot be blank.';
        }
        if (empty($email)) {
            $errors[] = 'Email cannot be blank.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        } elseif (User::where('email', $email)->exists()) {
            $errors[] = 'Email is already taken.';
        }
        if (empty($password)) {
            $errors[] = 'Password cannot be blank.';
        } elseif (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }
    
        // If there are errors, return back with errors
        if (!empty($errors)) {
            return back()->with('errors', $errors)->withInput();
        }
    
        // Create new user if validation passes
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
    
        return back()->with('success', 'Account created successfully!');
    }
    

    public function loginPost(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Account login success!');
        }
    
        return back()->with('error', 'Email and password did not match!');
    }
    
 
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}