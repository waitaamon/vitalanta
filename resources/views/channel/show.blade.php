@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <div class="media">
                            <div class="media-left">
                                <img src="{{  $channel->getImage() }}" alt=" {{ $channel->name }} image" class="media-object">
                            </div>

                            <div class="media-body">
                                {{ $channel->name }}

                                <ul class="list-inline">
                                    <li>
                                        <subscribe-button channel-slug="{{ $channel->slug }}"></subscribe-button>
                                    </li>
                                </ul>


                                @if($channel->description)
                                    <hr>
                                    <p>{{ $channel->description   }}</p>

                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Video uploads</div>

                    <div class="panel-body">
                        @if($videos->count())

                            @foreach($videos as $video)

                                @include('search.partials._video_result', [
                                    'video' => $video

                                ])

                            @endforeach

                            {{ $videos->links() }}

                        @else
                            <p>{{ $channel->name }} has no videos!!</p>

                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Images uploads</div>

                    <div class="panel-body">
                        @if(false)



                        @else
                            <p>{{ $channel->name }} has no images!!</p>

                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Audio uploads</div>

                    <div class="panel-body">
                        @if(false)



                        @else
                            <p>{{ $channel->name }} has no Audio!!</p>

                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
