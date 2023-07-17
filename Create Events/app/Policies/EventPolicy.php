<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    public function view(User $user, Event $event): Response
    {
        return $user->id === $event->user_id ? Response::allow() : Response::deny();
    }

    public function create(User $user): Response
    {
        return auth()->user()->id === $user->id ? Response::allow() : Response::deny();
    }

    public function update(User $user, Event $event): Response
    {
        return $user->id === $event->user_id ? Response::allow() : Response::deny();
    }

    public function delete(User $user, Event $event): Response
    {
        return $user->id === $event->user_id ? Response::allow() : Response::deny();
    }
}
