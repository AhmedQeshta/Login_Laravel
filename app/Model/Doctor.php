<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'title','hospital_id'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

    //################ Relations ################
        // to many to one (doctor <--- hospital)
    public function hospital(){
        return $this->belongsTo('App\Model\Hospital','hospital_id' ,'id');
    }
//################# End ###################
}
