@extends('layouts.app')



@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin DashBord </div>
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
                            <div class="alert alert-success">
                                You Are in (Admin DashBord) , ^___^
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
