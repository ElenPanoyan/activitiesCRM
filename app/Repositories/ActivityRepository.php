<?php

namespace App\Repositories;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ActivityRepository
{
    public function getList()
    {
        return Activity::all();
    }

    public function create(array $data)
    {
        return Activity::create($data);
    }

    public function delete($id)
    {
        return Activity::find($id)->delete();
    }

    public function findById($id)
    {
        return Activity::find($id);
    }

    public function addActivityUser($activity_id, $user_id)
    {
        return DB::table('activity_user')->insert([
            'activity_id' => $activity_id,
            'user_id' => $user_id
        ]);
    }

    public function getActivityUsers($id)
    {
        return DB::table('activity_user')
            ->where(['activity_id' => $id])
            ->pluck('user_id')
            ->toArray();
    }

    public function update(array $data, Activity $activity): bool
    {
        return $activity->update($data);
    }

    public function getUserActivities($user_id, $startDate = '', $endDate = '')
    {
        if ($startDate != '' && $endDate != '') {
            return Activity::where(function ($query) use ($endDate, $startDate) {
                $query->whereBetween('date', [$startDate, $endDate])
                    ->where('is_public', 1);
            })
                ->orWhere(function ($query) use ($endDate, $startDate, $user_id) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                    $query->whereHas('users', function ($subQuery) use ($user_id) {
                        $subQuery->where('users.id', $user_id);
                    });
                })
                ->get();
        } else {
            return Activity::where('is_public', 1)
                ->orWhere(function ($query) use ($user_id) {
                    $query->whereHas('users', function ($subQuery) use ($user_id) {
                        $subQuery->where('users.id', $user_id);
                    });
                })
                ->get();
        }
    }

    public function getActivitiesByDate($date)
    {
        return Activity::where(['date' => $date])->count();
    }
}
