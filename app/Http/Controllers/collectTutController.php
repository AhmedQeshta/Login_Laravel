<?php

namespace App\Http\Controllers;

use App\Model\Offer;
use Illuminate\Http\Request;

class collectTutController extends Controller
{
    public function index(){
//        $numbers = [1,2,3,5,52,5,25,55,55,285,3553,553,2515];
//        $col = collect($numbers);
//        return $col->avg();
//        return $col->count();
//        return $col->add(99999999);

//        $names = collect(['name','age']);
//        $res = $names ->combine(['ahmed',25]);
//        return $res;

//        $numbers = [1,2,3,5,52,5,5,5,5,5,55,55,285,3553,553,2515];
//        $col = collect($numbers);
//        return $col->countBy();
//        return $col->duplicates();


    }
########### (each , filter , search  , transform ) #############
    public function complexEach(){

        $offers = Offer::get();
        $offers = collect($offers);
       #(1)#### each ###
        // remove column
            $offers->each(function ($offer){
                unset($offer->created_at);
                unset($offer->updated_at);
                if ($offer->status == 0)
                    // add
                    $offer->title = 'not Active';
                return $offer;
            });
            return $offers;

    }

    public function complexFilter(){
        $offers = Offer::get();
        $offers = collect($offers);//change to collection
        #(2)#### filter ###
        $resultFilter  = $offers->filter(function ($value,$key){
            return $value['status'] == 1 ; // if status == 1
        });

        return array_values($resultFilter->all());



    }
    public function complexTransform(){
        $offers = Offer::get();
        $offers = collect($offers);//change to collection
        #(2)#### Transform ###

        $resultFilter  = $offers->transform(function ($value,$key){
            return 'Offer : ' . $value['name_en'] ;
        });

        return $resultFilter;

    }
}
