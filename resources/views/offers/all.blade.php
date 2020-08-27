@extends('layouts.app')



@section('content')
    <div class="container py-5">
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
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('test.OfferName')}}</th>
                <th scope="col">{{__('test.offerPrice')}}</th>
                <th scope="col">{{__('test.image')}}</th>
                <th scope="col">{{__('test.operation')}}</th>
            </tr>
            </thead>
            <tbody>

            @forelse($offersWithOutAjax as $offerWithOutAjax)
            <tr>
{{--                <th scope="row">{{$offer->id}}</th>--}}
                <td>{{ ++$i }}</td>
                <td>{{$offerWithOutAjax->name}}</td>
                <td>{{$offerWithOutAjax->price}} <strong> $ </strong></td>
                <td><img class="d-flex text-center " src="{{asset($offerWithOutAjax->photo)}}" width="100px"  alt="{{$offerWithOutAjax->name_ar}}"></td>
                <td>
                    <span class="px-2">
                    <a href="{{route('offers.edit',$offerWithOutAjax->id)}}" class="btn btn-success">{{__('test.message.edit')}}</a>
                    <a href="{{route('offers.destroy',$offerWithOutAjax->id)}}" class="btn btn-danger">{{__('test.message.delete')}}</a>
                    </span>
                </td>

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
            {{ $offersWithOutAjax->links() }}
        </div>
    </div>


@endsection
