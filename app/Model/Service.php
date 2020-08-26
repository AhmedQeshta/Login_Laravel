<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];
    protected $hidden = [
        'created_at','updated_at','pivot'
    ];

    //Services has many doctors ,doctors has many Services    (many to many)
    public function doctors(){
        return $this -> belongsToMany('App\Model\Doctor','doctor__services','service_id','doctor_id','id','id');
    }

}
