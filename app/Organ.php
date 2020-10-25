<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
	protected $guarded = ['id'];
	protected $appends = ['full_name', 'stat'];

	public function getFullNameAttribute()
	{
		return $this->in_charge_first_name . ' ' . $this->in_charge_last_name;
	}

	public function getStatAttribute()
	{
		return __("stat{$this->status}");
	}

}
