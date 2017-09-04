<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'category',
        'description',
        'live',
        'allow_votes',
        'allow_comments',
        'approved',
        'finished'
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($file){
            $file->identifier = uniqid(true);
        });
    }

    //return all finished files
    public function scopeFinished(Builder $builder){

        return $builder->where('finished', true);
    }


    //Route key name
    public function getRouteKeyName(){
        return 'identifier';
    }


    //user post relationship
    public function user(){
        return $this->belongsTo(User::class);
    }

    //channel post relationship
    public function channel(){
        return $this->belongsTo(Channel::class);
    }
}