<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function storeUser($createUserRequest)
    {
        $user = new User();
        $user->name = $createUserRequest->get('name');
        $user->password = bcrypt($createUserRequest->get('password'));
        $user->email = $createUserRequest->get('email');
        $user->role = 'front-desk-agent';

        if($user->save()) {
            return redirect()->back()->with('message', 'User: ' . $user->name . ' was successfully created');
        }
    }

    public static function updateUser($updateUserRequest)
    {

        $user = User::find($updateUserRequest->get('user_id'));
        if($updateUserRequest->has('password')) {
            $user->update([
                'name' => $updateUserRequest->get('name'),
                'email' => $updateUserRequest->get('email'),
                'password' => bcrypt($updateUserRequest->get('password'))
            ]);
        }

        $user->update([
                'name' => $updateUserRequest->get('name'),
                'email' => $updateUserRequest->get('email')
            ]);

        return redirect()->back()->with('message', 'You have successfully updated [ User :: ' . $user->name . ' ] information');
    }
}
