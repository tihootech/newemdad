<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['stat', 'full_name'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getStatAttribute()
	{
		return __("stat{$this->status}");
	}

    public function getFullNameAttribute()
    {
        $first_name = $this->person->first_name ?? '';
        $last_name = $this->person->last_name ?? '';
        return $first_name . ' '. $last_name;
    }
}
