<?php

namespace App\Models;

use App\Traits\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /** @use HasFactory<\Database\Factories\SubmissionFactory> */
    use HasFactory;
    protected $fillable = ['homework_id', 'student_id', 'answer', 'grade'];

    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
