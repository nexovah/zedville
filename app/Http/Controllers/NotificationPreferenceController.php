<?php

namespace App\Http\Controllers;

use App\Models\NotificationPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationPreferenceController extends Controller
{
    /**
     * Persist the checkbox state from Settings > Notifications.
     * Unchecked categories are simply absent from the request, so any
     * category not present in $request->categories is written as disabled.
     */
    public function update(Request $request)
    {
        $userId = Auth::id();
        $checked = (array) $request->input('categories', []);

        foreach (NotificationPreference::CATEGORIES as $category) {
            NotificationPreference::updateOrCreate(
                ['user_id' => $userId, 'category' => $category],
                ['enabled' => in_array($category, $checked, true)]
            );
        }

        return back()->with('status', 'notification-preferences-updated')->withFragment('tab7');
    }
}
