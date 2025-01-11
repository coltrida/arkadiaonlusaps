<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function associaclients()
    {
        return $this->belongsToMany(Client::class, 'associa');
    }
}
