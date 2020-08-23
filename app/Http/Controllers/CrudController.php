<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Model\Offer;
use Illuminate\Http\Request;
use File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $offers = Offer::select('id','name_'.LaravelLocalization::getCurrentLocale(). ' as name','price','photo');
        $offers = $offers->latest()->paginate(2);
        return view('offers.all',compact('offers'))->with('i', (request()->input('page', 1) - 1) * 2);
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
        $request->validate($request->rules(),$request->messages());

        // save data in DB
        // to img store
        if($request->hasFile('offer_image')){
            // update img
            $imagePath = parent::uploadImage($request->file('offer_image'),'image/offers');
        }

        $request['photo'] = $imagePath ;
        $request['name_ar'] = $request->name_ar;
        $request['name_en'] = $request->name_en ;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
