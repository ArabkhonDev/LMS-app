<?php

namespace App\Models;

use App\Traits\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory, Guarded;

    public function groups(){
        return $this->belongsToMany(Group::class);
    }
    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
