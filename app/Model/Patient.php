<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'age'
    ];
    protected $hidden = [
        'created_at','updated_at',
    ];

    //################ Relations ################
    // Doctors ----> Medical <----- Patient
    // has one through
    public function doctor(){
        return $this -> hasOneThrough('App\Model\Doctor','App\Model\Medical','patient_id','medical_id','id','id');
    }
}
