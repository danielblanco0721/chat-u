<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::where('id', '!=', auth()->id())->get();
        return view('dashboard',compact('users'));
    }
}
