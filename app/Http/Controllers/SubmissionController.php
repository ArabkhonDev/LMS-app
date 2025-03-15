<?php


namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function store(Request $request, Homework $homework)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $submission = Submission::create([
            'homework_id' => $homework->id,
            'student_id' => Auth::id(),
            'answer' => $request->answer,
        ]);

        return response()->json($submission, 201);
    }

    public function grade(Request $request, Submission $submission)
    {
        if (Auth::id() !== $submission->homework->lesson->course->teacher_id) {
            return response()->json(['message' => 'Faqat o‘z talabalarining ishlarini baholashingiz mumkin!'], 403);
        }

        $request->validate([
            'grade' => 'required|integer|min:0|max:100',
        ]);

        $submission->update(['grade' => $request->grade]);

        return response()->json($submission);
    }
}

