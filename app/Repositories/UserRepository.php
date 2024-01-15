<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => hash('sha256', Str::random(60))
        ]);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getUsersByRole($role)
    {
        return User::where('role', '=', $role)->get();
    }

    public function getUserActivities(User $user)
    {
        return $user->activities()->toArray();
    }

    public function delete($id)
    {
        return User::find($id)->delete();
    }
}
