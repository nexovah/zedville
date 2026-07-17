<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\EmailTemplate;
use App\Models\User;
use App\Models\Mailbox;

class AdminEmailTemplateController extends Controller
{
    public function index(Request $request)
{
    // Get the 'id' from query string, default to 1 if not provided
    $id = $request->query('id', 1);

    // Fetch the email template
    $emailTemplate = EmailTemplate::find($id);

    // Optional: handle if template not found
    if (!$emailTemplate) {
        abort(404, 'Email template not found');
    }

    // Pass to the view
    return view('admin.email-template.index', compact('emailTemplate'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'content' => 'required',
    ]);

    $emailTemplate = EmailTemplate::findOrFail($id);
    $emailTemplate->subject = $request->input('subject');
    $emailTemplate->content = $request->input('content');
    $emailTemplate->save();
    return redirect('admin/email-template?id='. $id)->with('success', 'Email template updated successfully!');
}
public function communication(Request $request)
{
    //$users = User::where('role', 4)->get();
    /*
    if ($request->send_type === 'all') {
    $users = User::where('role', 4)->get();
} else {
    $users = User::whereIn('id', $request->user_ids)->get();
}
    
    */
$selectedSchool = session('selected_school');

    $users = User::where('role', 4)
        ->when($selectedSchool, function ($query) use ($selectedSchool) {
            $query->where('sid', $selectedSchool);
        })
        ->get();
    // Pass to the view
    return view('admin.email-template.communication', compact('users'));
}
public function send(Request $request)
    {
        $request->validate([
            'send_type' => 'required|in:all,selected',
            'subject'   => 'required|string|max:255',
            'content'   => 'required|string',
        ]);

        // Get recipients
        if ($request->send_type === 'all') {
            $users = User::where('role', 4)->pluck('id'); // students
        } else {
            $request->validate([
                'user_ids' => 'required|array|min:1'
            ]);

            $users = collect($request->user_ids);
        }

        // Insert into mailbox
        $data = $users->map(function ($userId) use ($request) {
            return [
                'student_id' => $userId,
                'sid' => session('selected_school'),
                'subject'    => $request->subject,
                'content'    => $request->content,
                'type'       => 'primary',
                'read'       => 0,
                'adminemail'       => 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ];
        })->toArray();

        Mailbox::insert($data);

        return redirect()->back()->with('success', 'Email sent successfully');
    }
    public function sentEmail()
    {
        $sid = session('selected_school');
        // Select all emails sent by admin (student_id = 1)
        $emails = Mailbox::where('adminemail', 1)
            ->when($sid, function ($q) use ($sid) {
                $q->where('sid', $sid);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Optional: load recipient info if needed
        // If student_id = recipient, and you store actual user, you can join
        $emails->load('student'); // assumes relation in Mailbox model

        return view('admin.email-template.all-sent-email', compact('emails'));
    }
}