<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        $user = User::find(auth()->id());
        return view('user.profile', compact('user'));
    }

    public function store(UserRequest $request, $id){
        $data = $request->data();
        $user = User::find($id);
        $user->update($data);
        toastr('Profil berhasil diubah!');
        return redirect()->back();
    }
}
