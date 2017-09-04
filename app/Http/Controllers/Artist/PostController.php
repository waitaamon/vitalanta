<?php

namespace App\Http\Controllers\Artist;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    //initial create post

    public function create(Post $post){



        if(!$post->exists){
            $post = $this->createAndReturnSkeletonFile();

            return redirect()->route('account.posts.create', $post);
        }

        $this->authorize('touch', $post);

        //render form

        return view('account.posts.create', [
            'post' => $post
        ]);
    }

    public function store(Request $request){

            dd('ok');
        //generate uid

        //grab user channel
    }

    //create skeleton post

    protected function createAndReturnSkeletonFile(){


        return auth()->user()->posts()->create([
            'title' => 'Untitled',
            'category' => 'all',
            'description' => 'None',
            'finished' => false
        ]);
    }

}
