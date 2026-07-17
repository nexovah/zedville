<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StatementController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $latestStatement = $user->bankStatements()
                                ->latest('generated_for')
                                ->first();

        return view('statement.show', compact('latestStatement'));
    }
}
