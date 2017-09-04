<?php
/**
 * Created by PhpStorm.
 * User: gathoka
 * Date: 4/6/17
 * Time: 11:38 AM
 */

namespace App\Traits;

trait Orderable {

    public function scopeLatestFirst($query){

        return $query->orderBy('created_at','desc');
    }
}