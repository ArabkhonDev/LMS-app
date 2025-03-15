<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        if (Auth::id() !== $lesson->course->teacher_id) {
            return response()->json(['message' => 'Faqat o‘z darslaringizga uy vazifasi qo‘shishingiz mumkin!'], 403);
        }

        $request->validate([
            'description' => 'required|string',
            'deadline' => 'required|date',
        ]);

        $homework = $lesson->homework()->create($request->only(['description', 'deadline']));

        return response()->json($homework, 201);
    }

    public function index(Lesson $lesson)
    {
        return $lesson->homework;
    }
}

