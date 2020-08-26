@extends('layouts.app')



@section('content')
            <div class="card-title text-center"> Doctors </div>
            <div class="content col-auto">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Job</th>
                        <th scope="col">operations</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($doctors) && $doctors->count() > 0)
                        @foreach($doctors as $doctor)
                            <tr>
                                <th class="text-center" scope="row">{{ ++$i }}</th>
                                <td class="text-center">{{$doctor->name}}</td>
                                <td class="text-center">{{$doctor->title}}</td>
                                <td class="text-center btn btn-success"><a href="{{route('relation.doctorServices', $doctor->id)}}"> Services </a></td>
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

@endsection
