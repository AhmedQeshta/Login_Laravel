<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor_Service extends Model
{
    protected $table = 'doctor__services';

    protected $primaryKey = 'id';

    protected $fillable = [
        'doctor_id','service_id'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];
}
