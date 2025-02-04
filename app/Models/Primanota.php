<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Primanota extends Model
{
    protected $table = 'primanotas';
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
