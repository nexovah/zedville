<?php

namespace App\Observers;

use App\Models\ReferendumVote;
use App\Services\NotificationService;

class ReferendumVoteNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(ReferendumVote $vote): void
    {
        if (! $vote->student_id) {
            return;
        }

        $question = optional($vote->referendum)->question ?? 'the referendum';

        $this->notifications->log(
            (int) $vote->student_id,
            'City Hall',
            'vote_cast',
            'Vote Recorded',
            "Your \"{$vote->vote}\" vote on \"{$question}\" has been recorded.",
            'clipboard-check',
            'blue',
            $vote
        );
    }
}
