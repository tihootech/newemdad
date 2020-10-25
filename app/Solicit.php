<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicit extends Model
{
    protected $guarded = ['id'];

    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }
}
