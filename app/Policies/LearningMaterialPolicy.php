<?php

namespace App\Policies;

use App\Models\LearningMaterial;
use App\Models\User;

class LearningMaterialPolicy
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
        return $user->isStudent() || $user->isTeacher();
    }

    public function view(User $user, LearningMaterial $material): bool
    {
        return $user->isStudent() || $user->isTeacher();
    }

    public function create(User $user): bool
    {
        return false; // only manager via before()
    }

    public function delete(User $user, LearningMaterial $material): bool
    {
        return false; // only manager via before()
    }
}
