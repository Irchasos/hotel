@extends('layouts.frontend')
@section('content')
    <div class="container-fluid places">

        <h1 class="text-center">{{ trans('mainpage.available_rooms') }}</h1>

        @foreach($city->rooms->chunk(4) as $chunked_rooms)
            <div class="row">

                @foreach( $chunked_rooms as $room)

                    <div class="col-md-3 col-sm-6">

                        <div class="thumbnail">
                            <img class="img-responsive img-circle"
                                 src="{{$room->photos->first()->photo ?? $placeholder}}" alt="...">
                            <div class="caption">
                                <h3>Nr {{$room->room_number}} <small class="orange bolded">{{$room->price}}zł</small>
                                </h3>
                                <p>{{str_limit($room->description,80)}}</p>
                                <p><a href="{{route('room',['id'=>$room->id])}}" class="btn btn-primary" role="button">{{ trans('mainpage.details') }}</a><a
                                        href="{{route('room',['id'=>$room->id])}}#reservation"
                                        class="btn btn-success pull-right" role="button">{{ trans('mainpage.reservation') }}</a></p>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        @endforeach

    </div>
@endsection
