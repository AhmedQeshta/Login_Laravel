<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];
    protected $hidden = [
        'created_at','updated_at',
    ];

    // countries --M--> hospitals <---M-- doctors
    // has many  through
    public function doctors(){
        return $this->hasManyThrough('App\Model\Doctor', 'App\Model\Hospital', 'country_id', 'hospital_id', 'id', 'id');
    }

//لعرض المستشفيات الخاصة بالدولة يجب عمل علاقة جديدة في مودل الدولة
    public function hospitals(){
        return $this-> hasMany('App\Model\Hospital','country_id','id');
    }

}

