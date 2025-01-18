<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AttivitaCliente extends Model
{
    protected $table = 'activities_clients';
    protected $guarded = [];

    public function getGiornoformattatoAttribute()
    {
        return Carbon::make($this->giorno)->format('d-m-Y');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
