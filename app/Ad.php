<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['image_url', 'job_type_persian', 'gender_persian'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image) : null;
    }

    public function getJobTypePersianAttribute()
    {
        return $this->type == 'p' ? 'نیمه وقت' : 'پاره وقت';
    }

    public function getGenderPersianAttribute()
    {
        return $this->type == 'm' ? 'آقا' : ($this->type == 'f' ? 'خانم' : 'هردو');
    }

    public function markAsAccepted()
    {
        $this->accepted = true;
        $this->save();
    }
}
