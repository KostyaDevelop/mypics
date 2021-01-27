<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Avatar;

class MainController extends Controller
{
    public function index(){
        $user_all_id = User::pluck('id');
        $user_all_name = User::pluck('login');
        $avatar =Avatar::pluck('avatar');
        return view('home', [
                'user_all_id' => $user_all_id,
                'user_all_name' => $user_all_name,
                'avatar' =>  $avatar
            ]);
    }
//    public function register(){
//        return view('auth.register');
//    }

}
