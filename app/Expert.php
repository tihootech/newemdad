<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['username', 'full_name'];

    public function getUsernameAttribute()
    {
        return $this->user->name ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' '. $this->last_name;
    }

}
