<?php

namespace App\Models;

use App\GuardedTrait;
use App\Traits\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory, Guarded;

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
