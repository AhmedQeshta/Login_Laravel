<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Model\Country;
use App\Model\Doctor;
use App\Model\Hospital;
use App\Model\Patient;
use App\Model\Phone;
use App\Model\Service;
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

    ###################### many to many ############################
    public function getDoctorServices(){
        return $doctor = Doctor::with('services')->find(3);
    }
    public function getServicesDoctor(){
        return $services = Service::with(['doctors'=>function ($q){
            $q->select('doctors.id','name','title');
        }])->find(2);
    }
    public function getDoctorServicesById($doctorId){
        $doctor = Doctor::findOrFail($doctorId);
        $services = $doctor->services ; // one doctor services

        $doctors = Doctor::select('id','name')->get();
        $allServices = Service::select('id','name')->get();
        return view('hospital.services',compact('services','doctors','allServices'));
    }
    public  function saveServicesToDoctor(Request $request){
        $doctor = Doctor::findOrFail($request->doctor_id);
        $services = Service::findOrFail($request->services_id);


        //$doctor->services()->attach($request->services_id); // many to many insert to dataBase
        //$doctor->services()->sync($request->services_id); // to update and delete old data and insert new data
        $doctor->services()->syncWithoutDetaching($request->services_id); // to update and insert new data

        return redirect()->route('relation.doctorServicesById',$request->doctor_id);

    }

    ########################## Has 0ne through #########################################
    public function hasOneThroughRelation(){
        $patient = Patient::findOrFail(1);
        return $patient->doctor;
    }

    ########################## Has many through #########################################
    public function hasManyThroughRelation(){
        return $country = Country::with('doctors')->findOrFail(1);
    }
    public function hospitalIntoCountry($country_id){
        //ثم عرضها يكون في الكنترولر
        return $country = Country::with('hospitals')->findOrFail($country_id);


    }

}
