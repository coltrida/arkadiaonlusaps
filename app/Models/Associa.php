<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associa extends Model
{
    protected $table = 'associa';
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
