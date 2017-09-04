<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Requests\VideoCreateRequest;

class VideoController extends Controller
{

    //show video
    public function show(Video $video){


        return view('video.show', [
            'video' => $video
        ]);
    }


    //videos index page
    public function index(Request $request){

        //get videos for user

        $videos = $request->user()->videos()->latestFirst()->paginate(10);



        return view('video.index',[ 'videos' => $videos]);
    }


//edit video
    public function edit(Video $video){

        //authorize

        $this->authorize('edit', $video);


        return view('video.edit',[
            'video' => $video
        ]);

    }

    public function update(VideoUpdateRequest $request, Video $video){

        $this->authorize('update', $video);
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'allow_votes' => $request->has('allow_votes'),
            'allow_comments' => $request->has('allow_comments'),

        ]);

        if($request->ajax()){
            return response()->json(null, 200);
        }

        return redirect()->back();

    }

   public function store(VideoCreateRequest $request){


       //generate uid
        $uid = uniqid(true);

       //grab user cahnnel

       $channel = $request->user()->channel()->first();

       $video = $channel->videos()->create([
           'uid' => $uid,
           'title' => $request->title,
           'description' => $request->description,
           'visibility' => $request->visibility,
           'video_filename' => "{$uid}.{$request->extension}",
       ]);


       return response()->json([
           'data' => [
               'uid' => $uid,
           ]
       ]);
   }

   //delete video

    public function delete(Video $video){

        //authorize
        $this->authorize('delete', $video);


        //delete

        $video->delete();

        return redirect()->back();
    }

}
