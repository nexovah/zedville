<?php

namespace App\Helpers;

use App\Jobs\SendMailboxEmail;
use Illuminate\Support\Facades\Log;

class MailboxScheduler
{
    /**
     * Schedule all emails for a given event.
     *
     * @param string $eventName
     * @param int $userId
     */
    public static function scheduleForEvent(string $eventName, int $userId, array $extraData = [])
{
    $schedules = config("mailbox_schedule.events.$eventName", []);
    $cumulativeDelay = 0; // each email sequence delay

    foreach ($schedules as $mail) {

        // Validate required keys
        if (!isset($mail['template'], $mail['subject'], $mail['delay'])) {
            Log::warning("MailboxScheduler: Missing keys for event $eventName", $mail);
            continue;
        }

        // Replace placeholders in subject
        $subject = $mail['subject'];
        foreach ($extraData as $key => $value) {
            $subject = str_replace('{{' . $key . '}}', $value, $subject);
        }

        // Replace placeholders in body if needed
        if (isset($mail['body'])) {
            $body = $mail['body'];
            foreach ($extraData as $key => $value) {
                $body = str_replace('{{' . $key . '}}', $value, $body);
            }
            $extraData['body'] = $body;
        }

        // Increment cumulative delay
        $cumulativeDelay += $mail['delay'];

        // Dispatch the job
        SendMailboxEmail::dispatch(
            $userId,
            $mail['template'],
            $subject,
            $extraData
        )->delay(now()->addMinutes($cumulativeDelay));

        Log::info("MailboxScheduler: Scheduled email", [
            'user_id' => $userId,
            'event' => $eventName,
            'template' => $mail['template'],
            'subject' => $subject,
            'delay_minutes' => $cumulativeDelay,
        ]);
    }
}


    /**
     * Render a Blade template from mailbox_templates folder
     *
     * @param string $template
     * @param array $data
     * @return string
     */
    public static function renderMailboxTemplate(string $template, array $data = []): string
    {
        // Auto-prepend folder if not included
        if (!str_contains($template, '.')) {
            $template = "mailbox_templates.{$template}";
        }

        try {
            return view($template, $data)->render();
        } catch (\Throwable $e) {
            Log::error("MailboxScheduler: Template render failed", [
                'template' => $template,
                'error' => $e->getMessage(),
            ]);
            return "Template '$template' not found.";
        }
    }
}
