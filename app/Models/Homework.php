<?php

namespace App\Models;

use App\Traits\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    /** @use HasFactory<\Database\Factories\HomeworkFactory> */
    use HasFactory, Guarded;
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
