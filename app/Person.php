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

    public function applied($type)
    {
        if ($type == 1) {
            return JobApply::where('person_id', $this->id)->first();
        }
        if ($type == 2) {
            return LoanApply::where('person_id', $this->id)->first();
        }
        if ($type == 3) {
            return InsuranceApply::where('person_id', $this->id)->first();
        }
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function make_fresh()
    {
        for ($i=1; $i <=3 ; $i++) {
            if ($apply = $this->applied($i)) {
                $apply->status = 1;
                $apply->save();
            }
        }
    }
}
