<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Presenze extends Model
{
    protected $table = 'presenze';
    protected $guarded = [];

    public function getGiornoformattatoAttribute()
    {
        return Carbon::make($this->giorno)->format('d-m-Y');
    }
}
