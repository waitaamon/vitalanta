<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Traits\Orderable;


class Video extends Model
{
    //

    use SoftDeletes, Searchable, Orderable;


    protected $fillable = [
        'title',
        'description',
        'uid',
        'video_filename',
        'video_id',
        'processed',
        'visibility',
        'allow_votes',
        'allow_comments',
        'processed_percentage'
    ];

    public function toSearchableArray(){

        $properties = $this->toArray();

        $properties['visible'] = $this->isProcessed() && $this->isPublic();

        return $properties;
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function votes(){
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function views(){
        return $this->hasMany(VideoView::class);
    }


    public function getRouteKeyName(){
        return 'uid';
    }


    //get processing percentage
    public function processedPercentage(){
        return $this->processed_percentage;
    }

    public function isProcessed(){
        return $this->processed;
    }

    //get thumbanil
    public function getThumbnail(){

        if(!$this->isProcessed()){
            return config('amontube.buckets.videos') . '/default.jpg';
        }

        return config('amontube.buckets.videos') . '/' . $this->video_id .'_1.jpg';
    }

    //check votes
    public function votesAllowed(){
        return (bool) $this->allow_votes;
    }
    //check comments
    public function commentsAllowed(){
        return (bool) $this->allow_comments;
    }

    //is video private
    public function isPrivate(){
        return $this->visibility === 'private';
    }

    //is video public
    public function isPublic(){
        return $this->visibility === 'public';
    }


    //owned by user
    public function ownedByUser(User $user){
        return $this->channel->user->id === $user->id;
    }

    //check if video can be accessed
    public function canBeAccessed($user =null){

        if(!$user && $this->isPrivate()){
            return false;
        }

        if($user && $this->isPrivate() && $user->id !== $this->channel->user->id){
            return false;
        }

        return true;
    }

    //return video url
    public function gerStreamUrl(){

        return config('amontube.buckets.videos'). '/' . $this->video_id. '.mp4';
    }

    // video view count
    public function viewCount(){
        return $this->views->count();
    }


    //check upvote votes
    public function upVotes(){
        return $this->votes->where('type','up');
    }

    //check downvote votes
    public function downVotes(){
        return $this->votes->where('type','down');
    }

    public function voteFromUser(User $user){

        return $this->votes->where('user_id', $user->id);
    }

    public function comments(){

        return $this->morphMany(Comment::class, 'commentable')->where('reply_id', null);
    }

    public function scopeProcessed($query){

        return $query->where('processed', true);
    }

    public function scopePublic($query){

        return $query->where('visibility', 'public');
    }

    public function scopeVisible($query){

        return $query->processed()->public();
    }

}
