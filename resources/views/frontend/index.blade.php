@extends('layouts.frontend')
@section('content')
    <div class="container-fluid places">
        @if(session('norooms'))
            <p class="text-center red bolded">{{(session('norooms'))}}</p>

        @endif
        <h1 class="text-center">{{ trans('mainpage.interesting_places') }}</h1>


        @foreach ($objects->chunk(4) as $chuncked_object)
            <div class="row">
                @foreach($chuncked_object as $object)



                    <div class="col-md-3 col-sm-6">

                        <div class="thumbnail">
                            <img class="img-responsive" src="{{ $object->photos->first()->path ?? null }}" alt="...">

                            <div class="caption">
                                <h3>{{ $object->name }} <small>{{ $object->city->name }}</small></h3>
                                <p>{{ str_limit($object->description, 120) }}</p>
                                <p><a href="{{ route('object',['id'=>$object->id])  }}" class="btn btn-primary"
                                      role="button">{{ trans('mainpage.details') }}</a></p>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        @endforeach
        {{ $objects->links() }}
    </div>
@endsection
