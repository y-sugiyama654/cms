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

    /**
     * writeユーザーにadmin権限を付与
     *
     * @param User $user
     * @return void
     */
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';

        $user->save();

        session()->flash('success', 'User made admin successfully');

        return redirect(route('users.index'));
    }
}
