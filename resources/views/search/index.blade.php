@extends('layouts.login_register.login_register')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search for  " {{ Request::get('q') }} "</div>

                    <div class="panel-body">
                        @if($channels->count())

                            <h4>Channels</h4>

                            <div class="well">

                                @foreach($channels as $channel)

                                    <div class="media-left">
                                        <a href="/channel/{{ $channel->slug }}">
                                            <img src="{{$channel->getImage()}}" alt="{{$channel->name }}" class="media-object">
                                        </a>
                                    </div>

                                @endforeach
                                <div class="media-body">
                                    <a href="/channel/{{ $channel->slug }}" class="media-heading">{{ $channel->name }}</a>
                                    <ul class="list-inline">
                                        <li>{{ $channel->subscriptionCount() }} {{ str_plural('subscriber', $channel->subscriptionCount()) }}</li>
                                    </ul>
                                </div>
                            </div>

                        @endif

                        @if($videos->count())

                            @foreach($videos as $video)

                                <div class="well">
                                    @include('search.partials._video_result', [
                                        'video' => $video
                                    ])
                                </div>

                            @endforeach

                        @else

                            <p>No videos found.</p>

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection