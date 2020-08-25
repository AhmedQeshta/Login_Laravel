<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        try {
                      // name Relation in model
            $user = User::with(['phone' => function($query){
                $query->select('code','phone','user_id');
            }])->find(1);
                      // name Relation in model
            //   $phone = $user->phone
            return response()->json($user);
        }catch (Exception $exception){
            return response()->json('sory not found');
        }

    }
}
