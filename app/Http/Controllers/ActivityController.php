<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\User;
use App\Services\ActivityService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * @var ActivityService
     */
    protected $activityService;
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param ActivityService $activityService
     * @param UserService $userService
     */
    public function __construct(ActivityService $activityService, UserService $userService)
    {
        $this->activityService = $activityService;
        $this->userService = $userService;
    }

    public function index()
    {
        $user = [];
        $activities = $this->activityService->getList();
        return view('admin.pages.activities.index', compact('activities', 'user'));
    }

    public function view(Activity $activity)
    {
        return view('admin.pages.activities.view', compact('activity'));
    }

    public function create_view()
    {
        $users = $this->userService->getList();
        return view('admin.pages.activities.create', compact('users'));
    }

    public function update_view(Activity $activity)
    {
        $users = $this->userService->getList();
        $selectedUsers = $this->activityService->getActivityUsers($activity->id);
        return view('admin.pages.activities.update', compact('users', 'selectedUsers', 'activity'));
    }

    public function create(ActivityRequest $request)
    {
        try {
            return $this->activityService->create($request);
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, Activity $activity)
    {
        try {
            $this->activityService->update($request, $activity);
            return redirect('/activities');
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $this->activityService->delete($id);
            return redirect('/activities');
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUserActivities(Request $request)
    {
        try {
            $result = $this->activityService->getUserActivities($request);
            return response()->json(['result' => $result]);
        } catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(User $user)
    {
        $activities = $this->activityService->getList($user->id);
        return view('admin.pages.activities.index', compact('activities', 'user'));
    }
}
