<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getList();
        return view('admin.pages.users.index', compact('users'));
    }

    public function view(User $user)
    {
        $activities = $this->userService->getUserActivities($user);
        return view('admin.pages.activities.update', compact('activities', 'user'));
    }

    public function delete($id)
    {
        try {
            $this->userService->delete($id);
            return redirect('/users');
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function signUp(SignUpRequest $request)
    {
        try {
            $user = $this->userService->signUp($request->all());
            return response()->json(['user' => $user], 201);
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function signIn(SignInRequest $request)
    {
        try {
            $data = $request->only('email', 'password');
            $user = $this->userService->signIn($data);
            return response()->json(['user' => $user], 201);
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
