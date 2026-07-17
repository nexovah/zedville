<?php

namespace App\Http\Controllers;

use App\Services\FinheroPointService;
use Illuminate\Http\Request;
use App\Models\LoginQuestion;
use App\Models\LoginOption;
use App\Models\LoginQuizAttempt;
use Illuminate\Support\Facades\Auth;

class LoginQuizController extends Controller
{
    public function getTodayQuestion()
{
    $userId = Auth::id();

    // Check if already answered today
    $alreadyAnswered = LoginQuizAttempt::where('user_id', $userId)
        ->whereDate('created_at', now()->toDateString())
        ->exists();

    if ($alreadyAnswered) {
        return response()->json(['show' => false]);
    }

    // Get answered question IDs
    $answeredIds = LoginQuizAttempt::where('user_id', $userId)
        ->pluck('question_id');

    // Get ONE random question with its options
    //$question = LoginQuestion::with('options')
        //->whereNotIn('id', $answeredIds)
        //->inRandomOrder()
        //->first();
    $question = LoginQuestion::with('options')
    ->inRandomOrder()
    ->first();

    if (!$question) {
        return response()->json(['show' => false]);
    }

    // Shuffle options in PHP (safe & consistent)
    //$options = $question->options->shuffle()->values();
    $options = $question->options;

    return response()->json([
        'show'     => true,
        'id'       => $question->id,
        'question' => $question->question,
        'type'     => $question->type,
        'options'  => $options->map(function ($opt) {
            return [
                'id'   => $opt->id,
                'text' => $opt->option_text,
            ];
        }),
    ]);
}


/*public function getTodayQuestion()
{
    $user = Auth::user();
    $userId = $user->id;

    // ✅ Step 1: Already answered today?
    $alreadyAnswered = LoginQuizAttempt::where('user_id', $userId)
        ->whereDate('created_at', now()->toDateString())
        ->exists();

    if ($alreadyAnswered) {
        return response()->json(['show' => false]);
    }

    // ✅ Step 2: Get user's school_id
    $schoolId = $user->grade;
    // ✅ If no school → always Month 1
    if (!$schoolId) {
        $programMonth = 1;
    } else {
    // ✅ Step 3: Get school start month
    $startMonth = \App\Models\SchoolMonthSetting::where('school_id', $schoolId)
        ->value('start_month');

    // fallback safety
    if (!$startMonth) {
        $startMonth = 1; // default January
    }

    // ✅ Step 4: Current month
    $currentMonth = now()->month; // 1–12

    // ✅ Step 5: Convert to PROGRAM MONTH (🔥 main logic)
    $programMonth = ($currentMonth - $startMonth + 12) % 12 + 1;
    }
    // ✅ Step 6: Get answered question IDs (optional)
    $answeredIds = LoginQuizAttempt::where('user_id', $userId)
        ->pluck('question_id');

    // ✅ Step 7: Get question for THAT month
    $question = LoginQuestion::with('options')
        ->where('month_id', $programMonth)
        //->whereNotIn('id', $answeredIds) // optional
        ->inRandomOrder()
        ->first();

    if (!$question) {
        return response()->json(['show' => false]);
    }

    // ✅ Step 8: Return response
    return response()->json([
        'show'          => true,
        'program_month' => $programMonth, // 🔥 useful for debug
        'id'            => $question->id,
        'question'      => $question->question,
        'type'          => $question->type,
        'options'       => $question->options->map(function ($opt) {
            return [
                'id'   => $opt->id,
                'text' => $opt->option_text,
            ];
        }),
    ]);
}*/
    public function submit(Request $request)
    {
        $request->validate([
            'question_id' => 'required|integer',
            'option_id'   => 'required|integer',
        ]);

        $question = LoginQuestion::with('options')
            ->findOrFail($request->question_id);

        $selected = $question->options
            ->firstWhere('id', $request->option_id);

        if (!$selected) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid option.'
            ], 422);
        }

        $isCorrect = (bool) $selected->is_correct;

        LoginQuizAttempt::create([
            'user_id'     => Auth::id(),
            'question_id' => $request->question_id,
            'option_id'   => $request->option_id,
            'is_correct'  => $isCorrect,
        ]);

         // ✅ ADD POINT ONLY IF CORRECT
        if ($isCorrect) {
            app(FinheroPointService::class)->addPoints(auth()->id(), 'quiz', 'daily_quiz', 1);
        }

        // Get correct option text to show user
        $correctOption = $question->options->firstWhere('is_correct', true);

        return response()->json([
            'success'      => true,
            'is_correct'   => $isCorrect,
            'correct_text' => $correctOption ? $correctOption->option_text : '',
        ]);
    }
}