<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Model\Doctor;
use App\Model\Hospital;
use App\Model\Phone;
use App\User;
use Illuminate\Http\Request;


class RelationsController extends Controller
{
    public function hasOneRelation(){

                      // name Relation in model
            $user = User::with(['phoneUser' => function($query){
                $query->select('code','phone','user_id');
            }])->find(1);
                      // name Relation in model
//               $phone = $user->phone;
//            if (isset($user->phoneUser)) {
//                return  $user->phoneUser->code ;
//            }
            return response()->json($user);
    }

    public function hasOneReserveRelation(){
        $phone = Phone::with('user')->find(1);

        // make some att visible
        $phone->makeVisible(['user_id']);
//        $phone->makeHidden(['user_id']);
//        return $phone->user->makeHidden(['created_at' , 'updated_at','email_verified_at']);
        return $phone ;

    }

    public function getUserHasPhone(){
//      return  User::whereHas('phoneUser')->get();
      return  User::whereHas('phoneUser',function($query){
          $query->where('code', '00972');
      })->with('phoneUser')->get();
    }

    public  function  getUserHasNoPhone(){
        return  User::whereDoesntHave('phoneUser')->get();
    }

    ##################################333333
    public function getHospitalDoctorRelation(){
        $hospital= Hospital::whereId(2);
        $hospital= $hospital->with('doctors')->first();

        $doctors = $hospital->doctors ;
        foreach ($doctors as $doctor){
            echo 'name: ' . $doctor->name . ' | job: ' . $doctor->title .' <br>' ;
        }

        $doctor = Doctor::whereId(1);
        $doctor = $doctor->first();
        return $doctor -> hospital ;
//        return $hospital;
    }


    ###########################################333
    public function getAllHospitalRelation(){
        $hospitals = Hospital::select('id','name','address');
        $hospitals = $hospitals->latest()->paginate(5);
        return view('hospital.hospitals',compact('hospitals'))->with('i', (request()->input('page', 5) - 1) * 2);
    }
    public function getdoctorRelation($hospital_id){
        $hospital = Hospital::findOrFail($hospital_id);
        $doctors = $hospital->doctors;
//        $Doctors = $doctors->latest()->paginate(5);
        return view('hospital.doctors',compact('doctors'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    ######################################3
    public function getHospitalHasDoctorsRelation(){
        return Hospital::whereHas('doctors')->get();
    }
    public function getHospitalHasDoctorsJobDoctorRelation(){
        $hospitals = Hospital::with('doctors')->whereHas('doctors',function($query){
            $query->where('title', 'doctor');
        })->get();
        return $hospitals;
    }
    public function getHospitalHasNoDoctorsRelation(){
        return  Hospital::whereDoesntHave('doctors')->get();
    }

    ###########################################
    public function hospitalDelete($hospital_id){
            $hospital = Hospital::findOrFail($hospital_id);
            if (!$hospital){
                return abort('404');
            }
//            delete doctor
            $hospital->doctors()->delete();
            $hospital->delete();
            return  redirect()->route('relation.AllHospital')->with('success','success delete');
    }
}
