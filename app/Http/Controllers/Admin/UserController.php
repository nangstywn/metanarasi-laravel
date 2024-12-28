<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function index(Request $request)
    {
        $users = $this->user->fetch($request->all(), 10);
        return view('admin.user.index', compact('users'));
    }
}
