<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return Course::where('is_published', true)->with('teacher')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => Auth::id(),
        ]);

        return response()->json($course, 201);
    }

    public function update(Request $request, Course $course)
    {
        if (Auth::id() !== $course->teacher_id) {
            return response()->json(['message' => 'Siz faqat o‘z kurslaringizni tahrirlashingiz mumkin!'], 403);
        }

        $course->update($request->only(['title', 'description', 'is_published']));

        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        if (Auth::id() !== $course->teacher_id) {
            return response()->json(['message' => 'Siz faqat o‘z kurslaringizni o‘chira olasiz!'], 403);
        }

        $course->delete();

        return response()->json(['message' => 'Kurs o‘chirildi!']);
    }
}

