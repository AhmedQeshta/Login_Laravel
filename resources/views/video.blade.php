@extends('layouts.app')



@section('content')

            <div class="content col-auto">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Viewers</th>
                        <th scope="col">showVideo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($videos as $video)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$video->name}}</td>
                            <td>{{$video->viewers}}</td>
                            <td><a href="{{route('youtube.videoOne',$video->id)}}"><strong>{{$video->name}}</strong></a></td>
                            @empty
                                <tr>
                                    <td >Empty</td>
                                </tr>
                        </tr>

                    @endforelse

                    </tbody>
                </table>

                <div class="text-center">
                    {{ $videos->links() }}
                </div>

            </div>

@endsection
