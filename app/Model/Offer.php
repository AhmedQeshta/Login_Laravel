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

    #################### Mutators ###( use in set data )#######################
                ### set___column name___Attribute (EX. set(NameEn)Attribute -> this handle column {NameEn} form database table )
    public function setNameEnAttribute($value){
        $this->attributes['name_en'] = strtoupper($value);
    }
    #################### End Mutators ##########################

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
    #################### End (Register it) to use global scope ##############

}
