<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code', 'phone', 'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];


//################ Relations ################
    // one to one (phone --- user)
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
//################# End ###################

}
