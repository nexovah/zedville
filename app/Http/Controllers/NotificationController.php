<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct(private NotificationService $notifications) {}

    public function readOne(Request $request, int $id)
    {
        $this->notifications->markRead(Auth::id(), $id);

        return response()->json(['success' => true]);
    }

    public function readAll(Request $request)
    {
        $this->notifications->markAllRead(Auth::id());

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, int $id)
    {
        $this->notifications->delete(Auth::id(), $id);

        return response()->json(['success' => true]);
    }
}
