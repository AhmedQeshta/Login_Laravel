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
        'name_ar','name_en', 'price','photo','status'
    ];

    ###################### Scope ####################
    public function scopeInActiveOffer($query){
      return  $query -> where('status','=',0);
    }
    public function scopeNotNull($query){
        return $query->whereNotNull('status');
    }
    public function scopeNotNullAndInActive($query){
        return $query->whereNotNull('status')->where('status','=',0);
    }
}
