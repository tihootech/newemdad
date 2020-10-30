<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }
}
