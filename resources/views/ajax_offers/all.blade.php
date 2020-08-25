@extends('layouts.app')



@section('content')
    <div class="container py-5">
        <div class="col clo-md-12 py-2">
            <div class="alert alert-success " id="success_msg" style="display: none" role="alert">
                Save success
            </div>
            <div class="alert alert-danger " id="error_msg" style="display: none" role="alert">
                Error
            </div>
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

            @forelse($offers as $offer)
            <tr class="OfferRow{{$offer->id}}">
                <td>{{ ++$i }}</td>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}} <strong> $ </strong></td>
                <td><img class="d-flex text-center " src="{{asset($offer->photo)}}" width="100px"  alt="{{$offer->name_ar}}"></td>
                <td>
                    <span class="px-2">
                    <a href="{{route('ajax-offer.edit',$offer->id)}}" class="btn btn-success">{{__('test.message.edit')}}</a>
                    <a href="" offer_id="{{$offer->id}}" class="btn btn-danger delete_Ajax">{{__('test.message.ajax-offerDelete')}}</a>
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
            {{ $offers->links() }}
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).on('click','.delete_Ajax',function (e){
            e.preventDefault();
            var offerId =   $(this).attr('offer_id');
                console.log(offerId)
            $.ajax({
                type : 'post' ,
                url :'{{route('ajax-offer.destroy')}}',
                data : {
                    '_token' : "{{csrf_token()}}",
                    'id' : offerId,
                },
                success : function (data){
                    if (data.status == true){
                        $('#success_msg').show();
                    }
                    $('.OfferRow' + data.id).remove();
                },
                error:function (reject){

                }
            });
        });
    </script>
@endsection
