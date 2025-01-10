<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttivitaCliente extends Model
{
    protected $table = 'activities_clients';
    protected $guarded = [];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
