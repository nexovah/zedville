<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalendarEvent;
use Carbon\Carbon;


class CalendarEventController extends Controller
{
    /**
     * GET: Load all calendar events
     */
    /*public function getEvents()
    {
        return response()->json(
            CalendarEvent::orderBy('start', 'asc')->get()
        );
    }*/
    public function getEvents(Request $request)
{
    $today = Carbon::today();
    //$query = CalendarEvent::orderBy('start', 'asc');
     $query = CalendarEvent::whereDate('end', '>=', $today)
        ->orderBy('start', 'asc');

    // Check if "class" query parameter exists
    if ($request->has('class') && !empty($request->class)) {
        $query->where('classId', $request->class);
    }
    // ✅ Apply SID filter (only if selected)
    if (session()->has('selected_school')) {
        $query->where('sid', session('selected_school'));
    }
    $events = $query->get();

    return response()->json($events);
}

    /**
     * POST: Store new event
     */
    /*public function storeEvent(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'start'            => 'required|date',
            'end'              => 'required|date|after_or_equal:start',
            'description'      => 'nullable|string',
            'backgroundColor'  => 'nullable|string|max:20',
            'borderColor'      => 'nullable|string|max:20',
            'classId'         => 'nullable|string|max:255',   // new field
            'position'        => 'nullable|string|max:255',   // new field
            'repeatActivity'  => 'nullable|string|max:255',   // new field

        ]);

        $event = CalendarEvent::create($data);

        return response()->json($event, 201);
    }*/
    public function storeEvent(Request $request)
{
    $data = $request->validate([
        'title'           => 'required|string|max:255',
        'activitys'       => 'nullable|integer',   // ✅ int + nullable
        'activityType'    => 'nullable|integer',   // ✅ int + nullable
        'start'           => 'required|date',
        'end'             => 'required|date|after_or_equal:start',
        'description'     => 'nullable|string',
        'backgroundColor' => 'nullable|string|max:20',
        'borderColor'     => 'nullable|string|max:20',
        'class'           => 'nullable|string|max:255',  // incoming JSON key
        'position'        => 'nullable|string|max:255',
        'repeat_activity' => 'nullable|boolean',          // incoming JSON key
    ]);
    // ✅ Get SID from session (null if not selected)
    $sid = session()->has('selected_school') ? session('selected_school') : null;
    // Map JSON keys to DB columns
    $eventData = [
        'sid'             => $sid, 
        'title'           => $data['title'],
        'activitys'       => $data['activitys'],
        'activityType'    => $data['activityType'],
        'start'           => $data['start'],
        'end'             => $data['end'],
        'description'     => $data['description'] ?? null,
        'backgroundColor' => $data['backgroundColor'] ?? null,
        'borderColor'     => $data['borderColor'] ?? null,
        'classId'         => $data['class'] ?? null,          // map class → classId
        'position'        => $data['position'] ?? null,
        'repeatActivity'  => $data['repeat_activity'] ?? false, // map repeat_activity → repeatActivity
    ];

    $event = CalendarEvent::create($eventData);

    return response()->json($event, 201);
}

    /**
     * PUT: Update event
     */
    /*public function updateEvent(Request $request, $id)
    {
        $event = CalendarEvent::findOrFail($id);

        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'start'            => 'required|date',
            'end'              => 'required|date|after_or_equal:start',
            'description'      => 'nullable|string',
            'backgroundColor'  => 'nullable|string|max:20',
            'borderColor'      => 'nullable|string|max:20',
        ]);

        $event->update($data);

        return response()->json($event);
    }*/
    public function updateEvent(Request $request, $id)
{
    $event = CalendarEvent::findOrFail($id);

    $data = $request->validate([
        'title'           => 'required|string|max:255',
        'start'           => 'required|date',
        'end'             => 'required|date|after_or_equal:start',
        'description'     => 'nullable|string',
        'backgroundColor' => 'nullable|string|max:20',
        'borderColor'     => 'nullable|string|max:20',
        'class'           => 'nullable|string|max:255',  // incoming key
        'position'        => 'nullable|string|max:255',
        'repeat_activity' => 'nullable|boolean',          // incoming key
    ]);

    // Map JSON keys to DB columns
    $eventData = [
        'title'           => $data['title'],
        'start'           => $data['start'],
        'end'             => $data['end'],
        'description'     => $data['description'] ?? null,
        'backgroundColor' => $data['backgroundColor'] ?? null,
        'borderColor'     => $data['borderColor'] ?? null,
        'classId'         => $data['class'] ?? $event->classId,             // keep old if null
        'position'        => $data['position'] ?? $event->position,
        'repeatActivity'  => $data['repeat_activity'] ?? $event->repeatActivity,
    ];

    $event->update($eventData);

    return response()->json($event);
}

    /**
     * DELETE: Remove event
     */
    public function deleteEvent(Request $request, $id)
    {
        if ($request->confirm_code != $request->delete_code) {
        return back()->with('error', 'Confirmation code does not match.');
    }
        $event = CalendarEvent::findOrFail($id);
        $event->delete();

        return response()->json([
            'message' => 'Event deleted successfully'
        ]);
    }
}
