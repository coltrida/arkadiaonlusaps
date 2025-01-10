<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ricevuta extends Model
{
    protected $table = 'ricevutas';
    protected $guarded = [];

    public function getDataformattataAttribute()
    {
        return Carbon::make($this->dataRicevuta)->format('d/m/Y');
    }
}
