@extends('layouts.app')



@section('content')
            <div class="card-title text-center"> Services </div>
            <div class="content col-auto">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>


                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($services) && $services->count() > 0)
                        @foreach($services as $service)
                            <tr>
                                <th class="text-center" scope="row">{{ $service -> id }}</th>
                                <td class="text-center">{{$service->name}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td >Empty</td>
                        </tr>
                    @endif

                    </tbody>
                </table>

{{--                <div class="text-center">--}}
{{--                    {{ $doctors->links() }}--}}
{{--                </div>--}}

            </div>

            <div class="card">
                <div class="card-header">Add Services</div>
                <div class="col col-md-12">
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

                <div class="col col-md-12">
                    <div class="card-body">
                        <form action="{{route('relation.saveServicesToDoctor')}}" method="post">
                            @csrf
                            <lable>Doctors</lable>
                            <select class="form-control" name="doctor_id" id="">
                                <option value="-1">Doctors</option>
                                @forelse($doctors as $doctor)
                                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @empty
                                    <option value="-1">Empty</option>
                                @endforelse
                            </select>

                            <lable>Services</lable>
                            <select class="form-control" name="services_id[]" multiple>
                                @forelse($allServices as $allService)
                                    <option value="{{$allService->id}}">{{$allService->name}}</option>
                                @empty
                                    <option value="-1">Empty</option>
                                @endforelse
                            </select>

                            <br>
                            <div class="form-action">
                                <input type="submit" value="save" class="btn btn-primary">
                                <input type="reset" value="cancel" class="btn btn-default">
                            </div>

                        </form>

                    </div>
                </div>


            </div>


@endsection
