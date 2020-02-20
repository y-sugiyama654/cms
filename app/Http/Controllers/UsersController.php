<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
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
     * ユーザーのプロフィール編集画面表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('users.edit')->with('user', auth()->user());
    }

    /**
     * ユーザーの編集機能
     * @param UpdateProfileRequest $request
     * @return void
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        session()->flash('success', 'User updated successfully');

        return redirect()->back();
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
