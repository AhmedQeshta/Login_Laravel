@extends('layouts.app')



@section('content')
            <div class="card-title text-center"> Hospitals</div>
            <div class="content col-auto">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">name</th>
                        <th class="text-center" scope="col">Address</th>
                        <th class="text-center" scope="col">operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($hospitals) && $hospitals->count() > 0)
                        @foreach($hospitals as $hospital)
                            <tr>
                                <th class="text-center" scope="row">{{ ++$i }}</th>
                                <td class="text-center">{{$hospital->name}}</td>
                                <td class="text-center">{!! $hospital->address !!}</td>
                                <td class="text-center">
                                    <a class="btn btn-success " href="{{route('relation.doctor',$hospital->id)}}">
                                        <strong>Show Doctors</strong>
                                    </a>
                                    <a class="btn btn-danger " href="{{route('relation.hospitalDelete',$hospital->id)}}">
                                        <strong>Delete Hospital</strong>
                                    </a>
                                </td>
{{--                                @empty--}}
{{--                                    <tr>--}}
{{--                                        <td >Empty</td>--}}
{{--                                    </tr>--}}
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td >Empty</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <div class="text-center">
                    {{ $hospitals->links() }}
                </div>

            </div>

@endsection
