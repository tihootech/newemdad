<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['full_name'];

    public function getFullNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

    public function histories()
    {
        return $this->hasMany(History::class);
    }

}
