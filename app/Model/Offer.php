<?php

namespace App\Model;

use App\Scopes\OfferScope;
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

    ###################### Local Scope ####################
    public function scopeInActiveOffer($query){
      return  $query -> where('status','=',0);
    }
    public function scopeNotNull($query){
        return $query->whereNotNull('status');
    }
    public function scopeNotNullAndInActive($query){
        return $query->whereNotNull('status')->where('status','=',0);
    }

    #################### (Register it) to use global scope ##############
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }

}
