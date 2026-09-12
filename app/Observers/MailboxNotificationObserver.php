<?php

namespace App\Observers;

use App\Models\Mailbox;
use App\Services\NotificationService;

class MailboxNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(Mailbox $mail): void
    {
        if (! $mail->student_id) {
            return;
        }

        $this->notifications->log(
            (int) $mail->student_id,
            'Mailbox',
            'mailbox_message',
            'New Message',
            $mail->subject,
            'mail',
            'blue',
            $mail
        );
    }
}
