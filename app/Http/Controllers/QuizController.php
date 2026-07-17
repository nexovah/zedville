<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function getTodayQuestion()
    {
        $userId = Auth::id();

        // Check if user already answered today
        $alreadyAnswered = QuizAttempt::where('user_id', $userId)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($alreadyAnswered) {
            return response()->json(['show' => false]);
        }

        // Get a random question not yet answered by user
        $answered = QuizAttempt::where('user_id', $userId)->pluck('quiz_id');
        $quiz = Quiz::whereNotIn('id', $answered)->inRandomOrder()->first();

        if (!$quiz) {
            return response()->json(['show' => false]);
        }

        return response()->json([
            'show'     => true,
            'id'       => $quiz->id,
            'question' => $quiz->question,
            'options'  => json_decode($quiz->options), // ['a) ...', 'b) ...', 'c) ...', 'd) ...']
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answer'  => 'required|string',
        ]);

        $quiz = Quiz::find($request->quiz_id);
        $isCorrect = trim($request->answer) === trim($quiz->correct_answer);

        QuizAttempt::create([
            'user_id'    => Auth::id(),
            'quiz_id'    => $quiz->id,
            'answer'     => $request->answer,
            'is_correct' => $isCorrect,
        ]);

        return response()->json([
            'success'    => true,
            'is_correct' => $isCorrect,
            'correct'    => $quiz->correct_answer,
            'explanation'=> $quiz->explanation ?? null,
        ]);
    }
}