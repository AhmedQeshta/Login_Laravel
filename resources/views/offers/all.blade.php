@extends('layouts.app')



@section('content')
    <div class="container py-5">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('test.OfferName')}}</th>
                <th scope="col">{{__('test.offerPrice')}}</th>
                <th scope="col">{{__('test.image')}}</th>
            </tr>
            </thead>
            <tbody>

            @forelse($offers as $offer)
            <tr>
{{--                <th scope="row">{{$offer->id}}</th>--}}
                <td>{{ ++$i }}</td>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}} <strong> $ </strong></td>
                <td><img class="d-flex float-right " src="{{asset($offer->photo)}}" width="100px"  alt="{{$offer->name_ar}}"></td>

                @empty
                    <td>
                        <p >
                            {{__('test.Empty_Table')}}
                        </p>
                    </td>

            </tr>

            @endforelse

            </tbody>
        </table>
        <div class="text-center">
            {{ $offers->links() }}
        </div>
    </div>


@endsection
