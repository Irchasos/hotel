@extends('layouts.frontend')
@section('content')
    <div class="container-fluid places">

        <h1 class="text-center"> {{ $object->name }} <small>{{ $object->city->name }}</small></h1>

        <p>{{ $object->description }}</p>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#gallery" data-toggle="tab"
                                  aria-expanded="true">{{ trans('mainpage.image_gallery') }}</a></li>
            <li><a href="#people" data-toggle="tab" aria-expanded="true">{{ trans('mainpage.Object is liked')}} <span
                        class="badge">{{$object->users->count()}}</span></a>
            </li>
            <li><a href="#adress" data-toggle="tab" aria-expanded="false">{{ trans('mainpage.address') }}</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="gallery">
                @foreach($object->photos->chunk(3) as $chunked_photos)


                    <div class="row top-buffer">
                        @foreach($chunked_photos as $photo)


                            <div class="col-md-4">
                                <img class="img-responsive" src="{{$photo->path ?? $placeholder}}" alt="">
                            </div>

                        @endforeach
                    </div>

                @endforeach


            </div>
            <div class="tab-pane fade" id="people">

                <ul class="list-inline">
                    @foreach($object->users as $user)
                        <li><a href="{{route('person',['id'=>$user->id])}}"><img width="75" height="75"
                                                                                 title="{{$user->FullName}}"
                                                                                 class="media-object img-responsive"
                                                                                 src="{{$user->photos->first()->path}}"
                                                                                 alt="..."> </a></li>

                    @endforeach                </ul>


            </div>
            <div class="tab-pane fade" id="adress">
                <p>{{$object->address->street}} {{$object->address->number}}</p>
            </div>
        </div>

        <section>

            <h2 class="text-center">{{ trans('mainpage.object_rooms') }}</h2>

            @foreach($object->rooms->chunk(3) as $chunked_rooms)
                <div class="row">

                    @foreach($chunked_rooms as $room)
                        <div class="col-md-3 col-sm-6">

                            <div class="thumbnail">

                                @if($room->photos->isEmpty())
                                    {{dump($room->id)}}
                                @endif
                                <div class="caption">
                                    <h3>Nr {{$room->room_number}} </h3>
                                    <p>{{str_limit ($room->description,100)}}</p>
                                    <p><a href="{{route('room',['id'=>$room->id])}}" class="btn btn-primary"
                                          role="button">{{ trans('mainpage.details') }}</a><a
                                            href="{{route('room',['id'=>$room->id])}}#reservation"
                                            class="btn btn-success pull-right"
                                            role="button">{{ trans('mainpage.reservation') }}</a></p>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            @endforeach
        </section>

        <section>
            <h2 class="green">{{ trans('mainpage.object_comments') }}</h2>
            @foreach($object->comments as $comment)
                <div class="media">
                    <div class="media-left media-top">
                        <a title="{{$comment->user->FullName}}" href="{{route('person',['id'=>$comment->user->id])}}">
                            <img class="media-object" width="50" height="50"
                                 src="{{$comment->photos->first()->path ?? $placeholder}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        {{$comment->content}}
                        {!!  $comment->rating !!}


                    </div>
                </div>
                <hr>
            @endforeach        </section>

        @auth()
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample"
               aria-expanded="false"
               aria-controls="collapseExample">
                {{ trans('mainpage.add_comment') }}
            </a>
        @else
            <p><a href="{{route('login')}}">{{ trans('mainpage.zaloguj_si_aby_dodac_komentarz') }} </a></p>
        @endauth

        <div class="collapse" id="collapseExample">
            <div class="well">


                <form method="POST" action="{{route('addComment',['object_id'=>$object->id,'App\TouristObject'])}}"
                      class="form-horizontal">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="textArea" class="col-lg-2 control-label">{{ trans('mainpage.comment') }}</label>
                            <div class="col-lg-10">
                                <textarea required name="content" class="form-control" rows="3"
                                          id="textArea"></textarea>
                                <span class="help-block">{{ trans('mainpage.add_a_comment_about_this_object') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="select" class="col-lg-2 control-label">{{ trans('mainpage.rating') }}</label>
                            <div class="col-lg-10">
                                <select name="rating" class="form-control" id="select">
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">{{ trans('mainpage.send') }}</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>

        <section>
            <h2 class="red">{{ trans('mainpage.articles_about_the_object_area') }}</h2>
            @foreach($object->articles as $article)
                <div class="articles-list">
                    <h4 class="top-buffer">{{$article->title}}</h4>
                    <p><b> {{$article->user->FullName}}</b>
                        <i>{{$article->created_at}}</i>
                    </p>
                    <p>{{str_limit($article->content,300)}} </p> <a
                        href="{{route('article',['id'=>$article->id])}}">{{ trans('mainpage.more') }}</a>
                </div>

            @endforeach        </section>


        @auth
            @if($object->isLiked())
                <a href="{{route('unlike',['id'=>$object->id,'type'=>'App\TouristObject'])}}"
                   class="btn btn-primary btn-xs top-buffer">{{ trans('mainpage.unlike_this_object') }}</a>

            @else
                <a href="{{route('like',['id'=>$object->id,'type'=>'App\TouristObject'])}}"
                   class="btn btn-primary btn-xs top-buffer">{{ trans('mainpage.like_this_object') }}</a>

            @endif

        @else
            <p>
                <a href="{{route('login')}}"
                   class="btn btn-primary btn-xs top-buffer">{{ trans('mainpage.zaloguj_si_aby_polubi_ten_obiekt') }}</a>
            </p>
        @endauth
    </div>

@endsection
