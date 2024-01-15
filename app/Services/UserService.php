<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ActivityRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signUp($data)
    {
        return $this->userRepository->create($data);
    }

    public function signIn($data)
    {
        $user = $this->userRepository->findByEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return ['success' => false, 'message' => 'Incorrect credentials'];
        }
        $token = $user->createToken('authToken')->plainTextToken;
        return ['success' => true, 'token' => $token];
    }

    public function getList()
    {
        return $this->userRepository->getUsersByRole('user');
    }

    public function getUserActivities(User $user)
    {
        return $this->userRepository->getUserActivities($user);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
