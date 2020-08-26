<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'title','hospital_id','medical_id'
    ];
    protected $hidden = [
        'created_at','updated_at','pivot'
    ];

    //################ Relations ################
        // to many to one (doctor <--- hospital)
    public function hospital(){
        return $this->belongsTo('App\Model\Hospital','hospital_id' ,'id');
    }

        // Services has many doctors ,doctors has many Services   (many to many)
    public function services(){
        return $this->belongsToMany('App\Model\Service','doctor__services' , 'doctor_id' , 'service_id','id','id');
    }

    //   Doctor Connect Medical ,
    // Doctors ----> Medical <----- Patient
    // one to one through

//################# End ###################
}
