<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VideoViewController extends Controller
{

    const BUFFER = 30;

    public function store( Request $request, Video $video){

        if(!$video->canBeAccessed($request->user())){
            return;
        }

        //grab last view for user
        if($request->user()){
            $lastUserView = $video->views()->latestByUser($request->user())->first();


            //check if within buffer
            if($this->withinBuffer($lastUserView)){

                //return if too soon
                return;
            }
        }


        //grab last view for ipaddress
        $lastIpView = $video->views()->latestByIp($request->ip())->first();

        //chek if buffer
        if($this->withinBuffer($lastIpView)){

            //return if too soon
            return;
        }



        $video->views()->create([
            'user_id' => $request->user()->id ? $request->user()->id : null,
            'ip' => $request->ip()
        ]);

        return response()->json(null, 200);
    }

    protected function withinBuffer($view){

        return $view && $view->created_at->diffInSeconds(Carbon::now()) < self::BUFFER;
    }
}
