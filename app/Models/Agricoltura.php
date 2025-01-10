<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agricoltura extends Model
{
    protected $table = 'agricolturas';
    protected $guarded = [];

    /*public function getGiornosingoloAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->giorno)->day;
    }*/
}
