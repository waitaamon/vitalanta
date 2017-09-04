@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    @if($subscriptionVideos->count())

                        @foreach($subscriptionVideos as $video)

                                @include('search.partials._video_result', [
                                    'video' => $video

                                ])

                        @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
