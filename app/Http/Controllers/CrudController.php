<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\offerRequest;
use App\Model\Offer;
use App\Model\Video;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use mysql_xdevapi\Exception;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $offers = Offer::select('id','name_'.LaravelLocalization::getCurrentLocale(). ' as name','price','photo');
        $offers = $offers->latest()->paginate(PAGINATION_COUNT);
        return view('offers.all',compact('offers'))->with('i', (request()->input('page', ID_COUNT) - 1) * PAGINATION_COUNT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
//    use offerRequest from request file
    public function store(offerRequest $request)
    {

        // Validation
       //  use from class offerRequest
//        $request->validate($request->rules(),$request->messages());

        // save data in DB
        // to img store
        if($request->hasFile('offer_image')){
            // update img
            $imagePath = parent::uploadImage($request->file('offer_image'),'image/offers');
            $request['photo'] = $imagePath ;
        }

//        $request['name_ar'] = $request->name_ar;
  //      $request['name_en'] = $request->name_en ;
        Offer::create($request->all());


        return redirect()->back()
            ->with('success','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $offer = Offer::whereId($id)->firstOrFail();;
            return view('offers.edit',compact('offer'));
        }catch (\Throwable $th){
            return redirect()->route('offers.index')
                ->with('error','not Found this , test message');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            // Validation
            //  use from class offerRequest
            $request->validate($this->rules($id),$this->messages());

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

            return redirect('/offers')
                ->with('success', 'success Update');

        }catch (\Throwable $th){
            return redirect()->route('offers.index')
                ->with('error','not Found this , test message');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $offer =  Offer::findOrFail($id);

            /**  to delete the image also
             **
             ** if use soft deletes delete this code
             */
            if(File::exists(public_path($offer->photo))){

                File::delete(public_path($offer->photo));
            }
            $offer->delete();

            return redirect()->route('offers.index')
                ->with('success','success delete');
        }catch (\Throwable $th){
            return redirect()->route('offers.index')
                ->with('error','not Found this , test message');
        }

    }

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


    //    new function Get Video
    public function getVideo(){
        try {
            $videos = Video::where([]);
            $videos = $videos->latest()->paginate(PAGINATION_COUNT);
            return view('video',compact('videos'))
                ->with('i', (request()->input('page', ID_COUNT) - 1) * PAGINATION_COUNT);
        }catch (\Throwable $th){
            return redirect()->route('offers.index');
        }
    }
    public function getVideoOne($id){
        try {
            $video_one = Video::findOrFail($id);
            event(new VideoViewer($video_one));


            return view('video_one',compact('video_one'));
        }catch (\Throwable $th){
            return redirect()->route('offers.index');
        }
    }



}
