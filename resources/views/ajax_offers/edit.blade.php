@extends('layouts.app')



@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('test.offers') }}</div>
                    <div class="col clo-md-12 py-2">
                        <div class="alert alert-success " id="success_msg" style="display: none" role="alert">
                            Save success
                        </div>
                        <div class="alert alert-danger " id="error_msg" style="display: none" role="alert">
                            Error
                        </div>
                    </div>
                    <div class="card-body">
                            <form action="" id="offerFormUpdate" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group text-center">
                                        <input type="file"  class="@error('photo') is-invalid @enderror"  name="offer_image">

                                            <div id="photo_error" class=" alert-danger text-center" role="alert">
                                                <strong></strong>
                                            </div>

                                </div>

                                <div class="form-group">
                                    <label for="name_ar">{{__('test.NameAR')}}</label>
                                    <input type="text" id="input_name_ar_error" value="{{$offer->name_ar}}" required class="form-control" name="name_ar" value="{{ old('name_ar') }}"  >

                                            <span id="name_ar_error" class="alert-danger text-center" role="alert">
                                                <strong></strong>
                                            </span>

                                </div>
                                <input type="hidden" style="display: none" value="{{$offer->id}}"  name="id">
                                <div class="form-group">
                                    <label for="name_en">{{__('test.NameEN')}}</label>
                                    <input type="text" id="input_name_en_error" value="{{$offer->name_en}}" required class="form-control" name="name_en" value="{{ old('name_en') }}"  >

                                    <span id="name_en_error" class="alert-danger text-center" role="alert">
                                                <strong></strong>
                                            </span>

                                </div>

                                <div class="form-group">
                                    <label for="price">price</label>
                                    <input type="text" id="input_price_error" value="{{$offer->price}}" required class="form-control" name="price" value="{{ old('price') }}"  >

                                    <span id="price_error" class="alert-danger text-center" role="alert">
                                                <strong></strong>
                                            </span>

                                </div>

                                <div class="form-action">
                                    <a  id="save_offer_update" class="btn btn-primary">save</a>
                                    <input type="reset" value="cancel" class="btn btn-default">
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click','#save_offer_update',function (e){
            e.preventDefault();
            $('#photo_error ').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#input_name_ar_error').removeClass('is-invalid');
            $('#input_name_en_error').removeClass('is-invalid');
            $('#input_price_error').removeClass('is-invalid');

            //get all data from form (photo , name_ar , name_en , price , ...)
            var form = $('#offerFormUpdate');
            if (window.FormData){
                var formdataupdate = new FormData(form[0]);
            }

            $.ajax({
                type : 'post' ,
                enctype : 'multipart/form-data' ,
                url :'{{route('ajax-offer.update')}}',
                data : formdataupdate,
                processData : false,
                contentType : false,
                cache : false,
                success : function (data){
                    if (data.status == true){
                        $('#success_msg').show();
                    }
                },
                error:function (reject){
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                        $("#" + "input_" + key + "_error").addClass('is-invalid');
                    });
                }
            });
        });
    </script>
@endsection

