@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit your profile</div>

                    <div class="panel-body">

                        <form action="/channel/{{ $channel->slug }}/edit" method="post" enctype="multipart/form-data">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" >Profile Name</label>

                                    <input id="name" type="text" class="form-control"  name="name" value="{{ old('name') ? old('name') : $channel->name}}" >

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="phone" >Phone number</label>
                                <div class="input-group">
                                    <div class="input-group-addon">+254</div>
                                    <input id="phone" type="text" class="form-control"  name="phone" value="{{  $channel->phone ? $channel->phone : 'no phone details'}}" disabled="true">
                                </div>



                            </div>

                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug">Unique URL</label>

                                <div class="input-group">
                                    <div class="input-group-addon">{{ config('app.url') }} /channel/</div>
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') ? old('slug') : $channel->slug}}" >
                                </div>

                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description </label>

                                <textarea name="description" id="description"  class="form-control">{{ old('description') ? old('description') : $channel->description}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="description">Profile Image </label>

                                <input type="file" name="image" id="image">

                            </div>

                            <button class="btn" type="submit">Update</button>
                            {{csrf_field()}}
                            {{method_field('PUT')}}

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection