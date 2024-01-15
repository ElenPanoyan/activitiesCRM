<?php

namespace App\Services;

use App\Models\Activity;
use App\Repositories\ActivityRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityService
{
    protected $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function getList($user_id = null)
    {
        if ($user_id) {
            return $this->activityRepository->getUserActivities($user_id);
        }
        return $this->activityRepository->getList();
    }

    public function create(Request $request)
    {
        $data = $request->all();

        if (isset($data['date'])) {
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        }

        $existing_activities_count = $this->activityRepository->getActivitiesByDate($data['date']);
        if ($existing_activities_count > 4) {
            return redirect('/activities/new')->with('error', 'You can create maximum 4 activities for same date');
        }
        if ($request->image) {
            $filed = $request->image;
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'Activity' . DIRECTORY_SEPARATOR);
            $extension = $filed->getClientOriginalExtension();
            $imageName = pathinfo($filed->getClientOriginalName(), PATHINFO_FILENAME);
            $data_name = md5($imageName . microtime());
            $data_ = $data_name . '.' . $extension;
            $res = $filed->move($path, $data_);
            if (!$res) {
                return null;
            }
            if (!$data_) return response()->json(['message' => 'Something went wrong with file upload'], 400);
            $file_path = "/storage/Activity/" . $data_;
            $file_name = $data_;
            $data['image_path'] = $file_path;
            $data['image_name'] = $file_name;
        }

        if (isset($data['is_public']))
            $data['is_public'] = $data['is_public'] == 'on' ? 1 : 0;

        if (empty($data['users'])) {
            $data['is_public'] = 1;
        }
        $activity = $this->activityRepository->create($data);
        if (!empty($data['users'])) {
            foreach ($data['users'] as $user_id) {
                $this->activityRepository->addActivityUser($activity->id, $user_id);
            }
        }
        return redirect('/activities');
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->all();
        if ($data['deleted_file'] == 1) {
            if ($activity['image_path'] && $activity['image_name']) {
                Storage::delete('/public/Activity/' . $activity['image_name']);
                $activity->update([
                    'image_name' => null,
                    'image_path' => null
                ]);
            }
        }
        if (isset($data['date'])) {
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        }

        $existing_activities_count = $this->activityRepository->getActivitiesByDate($data['date']);
        if ($existing_activities_count > 4) {
            return redirect()->route('activities-update-view', ['activity' => $activity])->with('error', 'You can have maximum 4 activities for same date');
        }

        if ($request->image) {
            $filed = $request->image;
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'Activity' . DIRECTORY_SEPARATOR);
            $extension = $filed->getClientOriginalExtension();
            $imageName = pathinfo($filed->getClientOriginalName(), PATHINFO_FILENAME);
            $data_name = md5($imageName . microtime());
            $data_ = $data_name . '.' . $extension;
            $res = $filed->move($path, $data_);
            if (!$res) {
                return null;
            }
            if (!$data_) return response()->json(['message' => 'Something went wrong with file upload'], 400);
            $file_path = "/storage/Activity/" . $data_;
            $file_name = $data_;
            $data['image_path'] = $file_path;
            $data['image_name'] = $file_name;
        }
        if (isset($data['is_public'])) {
            $data['is_public'] = $data['is_public'] == 'on' ? 1 : 0;
        } else {
            $data['is_public'] = 0;
        }
        $this->activityRepository->update($data, $activity);
        $activity_users = $this->activityRepository->getActivityUsers($activity->id);
        if (isset($data['users'])) {
            if (!empty($data['users']) && $data['users'] != $activity_users) {
                foreach ($data['users'] as $user_id) {
                    $this->activityRepository->addActivityUser($activity->id, $user_id);
                }
            }
            $usersToAdd = array_diff($data['users'], $activity_users);
            $usersToRemove = array_diff($activity_users, $data['users']);

            $activity->users()->attach($usersToAdd);
            $activity->users()->detach($usersToRemove);
        } else {
            $activity->users()->detach($activity_users);
        }
    }

    public function delete($id)
    {
        $activity = $this->activityRepository->findById($id);
        if ($activity['image_path'] && $activity['image_name']) {
            Storage::delete('/public/Activity/' . $activity['image_name']);
        }
        return $this->activityRepository->delete($id);
    }

    public function getActivityUsers($id)
    {
        return $this->activityRepository->getActivityUsers($id);
    }

    public function getUserActivities(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $date_range = $request->input('date_range');
        if (!empty($date_range)) {
            $date_range = explode(' - ', $date_range);
            $startDate = Carbon::createFromFormat('m/d/y', $date_range[0])->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/y', $date_range[1])->endOfDay();
            $activities = $this->activityRepository->getUserActivities($user_id, $startDate, $endDate);
        } else {
            $activities = $this->activityRepository->getUserActivities($user_id);
        }
        return $activities;
    }
}
