<?php

namespace App\Http\Controllers;

use App\Steper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SteperController extends Controller
{

    public function __construct()
    {

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'numeric'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    protected function create(array $data)
    {
        return Steper::create([
            'name' => $data['name'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username'=> $data['username'],
            'password'=> $data['password'],


//            'password' => Hash::make($data['password']),
        ]);
    }

    public function index(){
        $user = Steper::all();
        $s= response(json_encode($user));
        return view('steper', compact('s'));

    }

    public function newindex(){

    }

}
