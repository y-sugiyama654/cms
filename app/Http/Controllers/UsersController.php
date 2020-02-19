<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * ユーザーの一覧表示
     *
     * @return void
     */
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }
}
