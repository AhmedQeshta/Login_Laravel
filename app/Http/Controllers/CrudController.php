<?php

namespace App\Http\Controllers;

use App\Model\Offer;
use Illuminate\Http\Request;
use File;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('offers.offer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate($this->rules());

        // save data in DB
        // to img store
        if($request->hasFile('offer_image')){
            // update img
            $imagePath = parent::uploadImage($request->file('offer_image'),'image/offers');
        }

        $request['photo'] = $imagePath ;
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

    private function rules($id= null){
        $rules = [];
        if($id){
            $rules['name'] = 'required|min:3|max:50|unique:offers,name,' . $id ;
            $rules['price'] = 'required|min:1|max:6';
            $rules['offer_image'] = 'mimes:png,jpg,jpeg' ;
        }else {
            $rules['name'] = 'required|min:3|max:50|unique:offers,name' ;
            $rules['price'] = 'required|min:1|max:6|' ;
            $rules['offer_image'] = 'required|mimes:png,jpg,jpeg' ;
        }

        return $rules;
    }
}
