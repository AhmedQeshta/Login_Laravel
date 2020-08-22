@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('offers') }}</div>
                    <div class="col clo-md-12">
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
                            <form action="{{route('offers.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group text-center">
                                        <input type="file" required class="@error('photo') is-invalid @enderror"  name="offer_image">
                                         @error('photo')
                                            <div class="invalid-feedback alert-danger text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input type="text" required class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  >
                                        @error('name')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">price</label>
                                    <input type="text" required class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  >
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
