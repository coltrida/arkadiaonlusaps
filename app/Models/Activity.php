<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function associaclients()
    {
        return $this->belongsToMany(Client::class, 'associa');
    }
}
