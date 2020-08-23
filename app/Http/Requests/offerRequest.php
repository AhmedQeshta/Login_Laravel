<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules($id= null){
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
