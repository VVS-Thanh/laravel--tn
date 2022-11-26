<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class UserController extends Controller
{
    public function authLogin(){
        return view('auth.login');

    }
    //register user
    public function register(){
        return view('auth.register');
    }


    public function customRegistation(RegisterRequest $request){
        // $this->validate(request, ['username' => 'require']);
       
        $request->validate($request->validated());
        $data = $request->all();
        $check = $this->create($data);
        return redirect("login")->with('success', "Account successfully registered.");   
    }


    public function registers(array $data, Request $request){
        $filename = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();
        dd($filename);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $filename,
            'active' => true,
            'user_role' => "user",
          ]);
    }

    // public function dashboard()
    // {
    //     // if(Auth::check()){
    //     //     return view('dashboard');
    //     // }
  
    //     return redirect("login")->withSuccess('Opps! You do not have access');
    // }
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect('/login')->withSuccess('Oppes! You have entered invalid credentials');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
  
        return Redirect('home');
    }
}
