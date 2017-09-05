<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','active','activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //user channel relationship
    public function channel(){
        return $this->hasMany(Channel::class);
    }

    //user post relationship
    public function posts(){
        $this->hasManyThrough(Post::class, Channel::class);
    }

    //videos
    public function videos(){
        return $this->hasManyThrough(Video::class, Channel::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function subscribedChannels(){

        return $this->belongsToMany(Channel::class, 'subscriptions');
    }


    //scope to activate account
    public function scopeByActivationColumns(Builder $builder, $email, $token){

        return $builder->where('email', $email )->where('activation_token',$token);
    }

    //scope to get user by email

    /**
     * @param Builder $builder
     * @param $email
     * @return Builder
     */
    public function scopeByEmail(Builder $builder, $email){

        return $builder->where('email', $email);
    }



    public function isSubscribedTo(Channel $channel){


        return (bool) $this->subscriptions->where('channel_id', $channel->id)->count();
    }


    public function ownsChannel(Channel $channel){

        return (bool) $this->channel->where('id', $channel->id)->count();
    }
}
