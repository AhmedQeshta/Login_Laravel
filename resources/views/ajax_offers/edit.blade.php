@extends('layouts.app')



@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('test.offers') }}</div>
                    <div class="col clo-md-12 py-2">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                            <form action="{{route('offers.update',$offer->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group text-center">
                                        <input type="file"  class="@error('photo') is-invalid @enderror"  name="offer_image">
                                         @error('photo')
                                            <div class="invalid-feedback alert-danger text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name_ar">{{__('test.NameAR')}}</label>
                                    <input type="text" value="{{$offer->name_ar}}" required class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}"  >
                                        @error('name_ar')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name_en">{{__('test.NameEN')}}</label>
                                    <input type="text" value="{{$offer->name_en}}" required class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}"  >
                                    @error('name_en')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">price</label>
                                    <input type="text" value="{{$offer->price}}" required class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  >
                                    @error('price')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="form-action">
                                    <input type="submit" value="save" class="btn btn-primary">
                                    <input type="reset" value="cancel" class="btn btn-default">
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
