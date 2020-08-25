<?php

namespace App\Http\Controllers;

use App\Model\Offer;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use File;
class OfferAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $offers = Offer::select('id','name_'.LaravelLocalization::getCurrentLocale(). ' as name','price','photo');
        $offers = $offers->latest()->paginate(2);
        return view('ajax_offers.all',compact('offers'))->with('i', (request()->input('page', 1) - 1) * 2);
    }



   public function create(){
        //view for data create offer
        return view('ajax_offers.create');
   }

    public function store(Request $request){
        //store  data , create by ajax
        // Validation
        //  use from class offerRequest
       $request->validate($this->rules(),$this->messages());

        // save data in DB
        // to img store
        if($request->hasFile('offer_image')){
            // update img
            $imagePath = parent::uploadImage($request->file('offer_image'),'image/offers');
            $request['photo'] = $imagePath ;
        }
       $offers = Offer::create($request->all());

        if ($offers){
             return response()->json([
                 'status' => true,
                 'message' => 'Good Jop , this Offer Add successfully',
             ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Sorry  , this Offer not Add successfully , try Again ',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application| \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        try {
            $offer = Offer::whereId($request->id)->firstOrFail();;
            return view('ajax_offers.edit',compact('offer'));
        }catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => 'Sorry  , this Offer not Add successfully , try Again ',
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->id);
            // Validation
            //  use from class offerRequest
            $request->validate($this->rules($request->id),$this->messages());

            /** edt image **/
            if($request->hasFile('offer_image')){
                // update img
                $imagePath = parent::uploadImage($request->file('offer_image'),'image/offers');
                // remove old image
                if(File::exists( public_path($offer->photo))){
                    File::delete(public_path($offer->photo));
                }
                $offer->photo = $imagePath;
            }

            $offer->update($request->all());

            if ($offer){
                return response()->json([
                    'status' => true,
                    'message' => 'Good Jop , this Offer Add successfully',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Sorry  , this Offer not Add successfully , try Again ',
                ]);
            }

        }catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => 'Sorry  , this Offer not Add successfully , try Again ',
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            $offer =  Offer::findOrFail($request->id);

            /**  to delete the image also
             **
             ** if use soft deletes delete this code
             */
            if(File::exists(public_path($offer->photo))){

                File::delete(public_path($offer->photo));
            }

            $offer->delete();
            if ($offer) return response()->json([
                'status' => true,
                'message' => 'Good Jop , this Offer Delete successfully',
                'id' => $request->id,
            ]);
        }catch (\Throwable $th){
            if (!$offer){
                return response()->json([
                    'status' => false,
                    'message' => 'Sorry  , this Offer not Delete successfully , try Again ',
                ]);
            }
        }

    }


/////////////////////////////// rules--------------------------------------
    private function rules($id= null){
        $rules = [];
        if($id){
            $rules['name_ar'] = 'required|min:3|max:50|unique:offers,name_ar,' . $id ;
            $rules['name_en'] = 'required|min:3|max:50|unique:offers,name_en,' . $id ;
            $rules['price'] = 'required|min:1|max:6';
            $rules['offer_image'] = 'mimes:png,jpg,jpeg' ;
        }else {
            $rules['name_ar'] = 'required|min:3|max:50|unique:offers,name_ar' ;
            $rules['name_en'] = 'required|min:3|max:50|unique:offers,name_en' ;
            $rules['price'] = 'required|min:1|max:6|' ;
            $rules['offer_image'] = 'required|mimes:png,jpg,jpeg' ;
        }

        return $rules;
    }

    public function messages(){
        $messages = [
            'name_ar.unique' => __('test.offerNameUniq'),
            'name_en.unique' => __('test.offerNameUniq'),
        ];
        return $messages;
    }
}
