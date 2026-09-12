<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Services\NotificationService;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request, NotificationService $notifications): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
            'password_changed_at' => now(),
        ]);

        $notifications->log(
            $request->user()->id,
            'Settings',
            'password_changed',
            'Password Changed',
            'Your account password was successfully updated on ' . now()->format('F j, Y') . '.',
            'shield',
            'amber'
        );

        return back()->with('status', 'password-updated')->withFragment('tab2');
    }
}
