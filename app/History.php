<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = ['id'];

    public static function make($type, $person_id, $date=null)
    {
        $h = new self;
        $des = 'ثبت نام مددجو برای '.persian_apply_type($type);
        $h->person_id = $person_id;
        $h->description = $des;
        if ($date) {
            $h->created_at = $date;
        }
        $h->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}
