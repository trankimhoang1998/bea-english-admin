<?php

namespace App\Policies;

use App\Models\TeachingHistory;
use App\Models\User;

class TeachingHistoryPolicy
{
    /**
     * Managers can do everything.
     */
    public function before(User $user): ?bool
    {
        return $user->isManager() ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->isTeacher();
    }

    public function view(User $user, TeachingHistory $history): bool
    {
        if ($user->isTeacher()) {
            return $user->teacher?->id === $history->teacher_id;
        }

        if ($user->isStudent()) {
            return $user->student?->id === $history->student_id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isTeacher();
    }

    public function update(User $user, TeachingHistory $history): bool
    {
        return $user->isTeacher() && $user->teacher?->id === $history->teacher_id;
    }

    public function delete(User $user, TeachingHistory $history): bool
    {
        return $user->isTeacher() && $user->teacher?->id === $history->teacher_id;
    }
}
