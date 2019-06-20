<?php

namespace App\Events;

use App\Message;
use App\User;
use App\Admin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $admin;
    public $mes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user,Message $mes)
    {
        $this->user = $user;
        $this->mes = $mes;
        //$this->dontBroadcastToCurrentUser();
    }
    // public function Admin(Admin $admin,Message $message)
    // {
    //     $this->admin = $admin;
    //     $this->message = $message;

    // }
    // public function User(User $user,Message $message)
    // {
    //     $this->user = $user;
    //     $this->message = $message;

    // }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('lChat-'.$user->id);
    }
}
