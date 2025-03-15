<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        return $course->lessons;
    }

    public function store(Request $request, Course $course)
    {
        if (Auth::id() !== $course->teacher_id) {
            return response()->json(['message' => 'Siz faqat o‘z kurslaringizga dars qo‘sha olasiz!'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $lesson = $course->lessons()->create($request->only(['title', 'content']));

        return response()->json($lesson, 201);
    }

    public function update(Request $request, Lesson $lesson)
    {
        if (Auth::id() !== $lesson->course->teacher_id) {
            return response()->json(['message' => 'Siz faqat o‘z darslaringizni tahrirlashingiz mumkin!'], 403);
        }

        $lesson->update($request->only(['title', 'content']));

        return response()->json($lesson);
    }

    public function destroy(Lesson $lesson)
    {
        if (Auth::id() !== $lesson->course->teacher_id) {
            return response()->json(['message' => 'Siz faqat o‘z darslaringizni o‘chira olasiz!'], 403);
        }

        $lesson->delete();

        return response()->json(['message' => 'Dars o‘chirildi!']);
    }
}

