<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'image_name',
        'is_public',
        'date'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
