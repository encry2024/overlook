<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    //
    public function index()
    {
        $ctr = 0;
        $users = User::where('role', '!=', 'admin')->paginate(20);
        $users->setPath('/users');

        return view('user.index', compact('users', 'ctr'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function store(CreateUserRequest $createUserRequest)
    {
        $storeUser = User::storeUser($createUserRequest);

        return $storeUser;
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $updateUserRequest)
    {
        $updateUser = User::updateUser($updateUserRequest);

        return $updateUser;
    }

    public function delete(User $user)
    {
        if($user->delete()) {
            return redirect()->route('user_index')->with('message', 'User: ' . $user->name . ' was successfully deleted');
        }
    }
}
