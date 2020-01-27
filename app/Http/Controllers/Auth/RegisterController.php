<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'numeric'],
            'dd' => ['required', 'string', 'max:255', 'numeric'],
            'mm' => ['required', 'string', 'max:255', 'numeric'],
            'yyyy' => ['required', 'string', 'max:255', 'numeric'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'checkbox' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'dd'=> $data['dd'],
            'mm'=> $data['mm'],
            'yyyy'=> $data['yyyy'],
            'username'=> $data['username'],
            'password'=> $data['password'],
            'checkbox'=> $data['checkbox'],

//            'password' => Hash::make($data['password']),
        ]);
    }

    public function index (){
        $user = User::all();
        $s= response(json_encode($user));
//        return $user ;
//        dd($s);
        return view('auth.register', compact('s'));
    }



    public function showRegistrationForm(){
        $user = User::all();
        $s= response(json_encode($user));
        return view('auth.register', compact('s'));

    }

//    public function register(){
//        $user = User::create();
//
//    }

}
