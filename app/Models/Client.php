<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    protected $guarded = [];

    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use SoftDeletes, HasFactory;

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activities_clients');
    }

    public function activitiesMensili()
    {
        return $this->belongsToMany(Activity::class, 'activities_clients')
            ->where('tipo', 'mensile')
            ->withPivot('quantita', 'costo', 'mese', 'anno', 'giorno', 'id');
    }

    public function activitiesOrario()
    {
        return $this->belongsToMany(Activity::class, 'activities_clients')
            ->where('tipo', 'orario')
            ->withPivot('quantita', 'costo', 'mese', 'anno', 'giorno', 'id');
    }

    public function asociazionimensili()
    {
        return $this->hasMany(Associa::class)->with('activity');
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }

    public function presenzeAgricoltura()
    {
        return $this->hasMany(Agricoltura::class, 'user_id')->where('tipo', 'P');
    }

    public function assenzeAgricoltura()
    {
        return $this->hasMany(Agricoltura::class, 'user_id')->where('tipo', 'A');
    }

    public function agricoltura()
    {
        return $this->hasMany(Agricoltura::class, 'user_id');
    }
}
