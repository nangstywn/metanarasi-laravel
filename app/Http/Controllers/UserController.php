<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        $user = User::find(auth()->id());
        return view('user.profile', compact('user'));
    }
}
