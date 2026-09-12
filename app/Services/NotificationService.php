<?php

namespace App\Services;

use App\Models\AppNotification;
use App\Models\NotificationPreference;
use App\Models\User;
use App\Models\UserLoginSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * ZEDVILLE — Notification System
 *
 * Central write/read point for the bell/notification drawer. Every real
 * event in the app (bank transaction, transfer, statement, activity,
 * badge, mood, mailbox message, donation, vote, petition, account
 * creation, password change, new-device login) is logged here via a small
 * Observer, never by editing the controller that originally performs the
 * action. See app/Observers/*.
 */
class NotificationService
{
    /**
     * Log a notification for one user, honouring their category preference.
     * Silently no-ops if the user has that category turned off — the event
     * itself still happened, we just don't surface it.
     */
    public function log(
        int $userId,
        string $category,
        string $type,
        string $title,
        ?string $body = null,
        ?string $icon = null,
        ?string $color = null,
        ?Model $source = null
    ): ?AppNotification {
        if (! $this->isEnabled($userId, $category)) {
            return null;
        }

        return AppNotification::create([
            'user_id'     => $userId,
            'category'    => $category,
            'type'        => $type,
            'title'       => $title,
            'body'        => $body,
            'icon'        => $icon,
            'color'       => $color,
            'source_type' => $source ? get_class($source) : null,
            'source_id'   => $source?->getKey(),
        ]);
    }

    /**
     * Log the same notification for every student in the given list —
     * used for class-wide events (e.g. an activity assigned to a class).
     */
    public function logForUsers(
        iterable $userIds,
        string $category,
        string $type,
        string $title,
        ?string $body = null,
        ?string $icon = null,
        ?string $color = null,
        ?Model $source = null
    ): void {
        foreach ($userIds as $userId) {
            $this->log($userId, $category, $type, $title, $body, $icon, $color, $source);
        }
    }

    public function isEnabled(int $userId, string $category): bool
    {
        $pref = NotificationPreference::where('user_id', $userId)
            ->where('category', $category)
            ->first();

        // No row yet = default on.
        return $pref ? $pref->enabled : true;
    }

    public function feed(int $userId, int $limit = 50)
    {
        return AppNotification::where('user_id', $userId)
            ->latest('id')
            ->limit($limit)
            ->get();
    }

    public function unreadCount(int $userId): int
    {
        return AppNotification::where('user_id', $userId)->whereNull('read_at')->count();
    }

    public function markRead(int $userId, int $id): bool
    {
        return (bool) AppNotification::where('user_id', $userId)
            ->where('id', $id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function markAllRead(int $userId): int
    {
        return AppNotification::where('user_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function delete(int $userId, int $id): bool
    {
        return (bool) AppNotification::where('user_id', $userId)->where('id', $id)->delete();
    }

    /**
     * "New Device Login" — hashes ip+user-agent, checks whether this
     * student has ever logged in from that device before. Always records
     * the session so the check is real from that point forward.
     */
    public function checkNewDevice(User $user, Request $request): void
    {
        $ip = (string) $request->ip();
        $agent = (string) $request->userAgent();
        $hash = hash('sha256', $ip . '|' . $agent);

        $seenBefore = UserLoginSession::where('user_id', $user->id)
            ->where('device_hash', $hash)
            ->exists();

        UserLoginSession::create([
            'user_id'     => $user->id,
            'ip_address'  => $ip,
            'user_agent'  => substr($agent, 0, 255),
            'device_hash' => $hash,
            'created_at'  => now(),
        ]);

        if (! $seenBefore) {
            $this->log(
                $user->id,
                'Settings',
                'new_device',
                'New Device Login',
                "Your account was accessed from a new device. If this wasn't you, please secure your account.",
                'shield',
                'red'
            );
        }
    }
}
