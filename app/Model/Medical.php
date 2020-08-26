<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $table = 'medicals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'pdf', 'patient_id'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

    //################ Relations ################
    // Doctors ----> Medical <----- Patient
        // one to one through

}
