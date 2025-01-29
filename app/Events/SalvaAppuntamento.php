<?php

namespace App\Events;

use App\Models\Appuntamento;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalvaAppuntamento implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $appuntamento;

    /**
     * Create a new event instance.
     */
    public function __construct(Appuntamento $appuntamento)
    {
        $this->appuntamento = $appuntamento;
        \Log::info('Evento PostCreated creato', ['appuntamento' => $appuntamento]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     *
     */
    public function broadcastOn()
    {
        return new Channel('appuntamenti');
    }

    public function broadcastWith()
    {
        return $this->appuntamento;
    }
}
