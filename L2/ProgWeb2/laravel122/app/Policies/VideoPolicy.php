<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\Response;

class VideoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'su']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'su']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Video $video): bool
    {
        return in_array($user->role, ['admin', 'su']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Video $video): bool
    {
        return $user->role === 'su';
    }
}
