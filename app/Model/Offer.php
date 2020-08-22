<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Offer extends Model
{
    /**
     *
     * @var table name
     *
     */
    protected $table = 'offers' ;


    protected $fillable = [
        'name', 'price','photo'
    ];
}
