@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if($video->isPrivate() && Auth::check() && $video->ownedByUser(Auth::user()))
                    <div class="alert alert-info text-center">
                        Your Video is private only you can see it.
                    </div>

                @endif


                @if($video->isProcessed() && $video->canBeAccessed(Auth::user()))

                    <video-player video-uid="{{ $video->uid }}" video-url="{{ $video->gerStreamUrl() }}" thumbnail-url="{{ $video->getThumbnail() }}"></video-player>

                @endif

                @if(!$video->isProcessed())
                    <div class="video-placeholder">
                        <div class="video-placeholder__header">
                            This Video is processing ... come back later.
                        </div>
                    </div>

                @elseif( !$video->canBeAccessed(Auth::user()))

                    <div class="video-placeholder">
                        <div class="video-placeholder__header">
                            This Video is Private.
                        </div>
                    </div>

                @endif


                <div class="panel panel-default">

                    <div class="panel-body">

                        <h4>{{ $video->title }}</h4>

                        <div class="pull-right">
                            <div class="video__views">
                                {{ $video->viewCount() }} {{ str_plural('view', $video->viewCount()) }}

                                @if($video->votesAllowed())

                                    <video-voting video-uid="{{ $video->uid }}"></video-voting>

                                @endif
                            </div>
                        </div>

                        <div class="media">
                            <div class="media-left">
                                <a href="/channel/{{ $video->channel->slug }}">
                                    <img src="{{ $video->channel->getImage() }}" alt=" {{ $video->channel->name }} image}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="/channel/{{ $video->channel->slug }}" class="media-heading">{{ $video->channel->name }} </a>

                                <subscribe-button channel-slug="{{ $video->channel->slug }}"></subscribe-button>
                            </div>
                        </div>

                    </div>
                </div>

                @if($video->description)
                    <div class="panel panel-default">

                        <div class="panel-body">
                            {!! nl2br(e($video->description)) !!}

                        </div>
                    </div>
                @endif

                <div class="panel panel-default">

                    <div class="panel-body">

                        @if($video->commentsAllowed())

                            <video-comments video-uid="{{ $video->uid }}"></video-comments>

                        @else

                            <p>Comments are dissabled for this video!</p>

                        @endif

                    </div>
                </div>

            </div>
        </div>

@endsection