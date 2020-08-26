<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospitals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'address','country_id',
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

    //################ Relations ################
    // one to many (doctor ---> hospital)
    public function doctors(){
        return $this->hasMany('App\Model\Doctor','hospital_id' ,'id');
    }


//################# End ###################
}
