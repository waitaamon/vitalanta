<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function activate(Request $request){

        $user = User::byActivationColumns($request->email, $request->token)->firstOrFail();

       $user->update([
           'active' => true,
           'activation_token' => null
       ]);

       Auth::loginUsingId($user->id);

       return redirect()->route('dashboard')->withSuccess('Activated! You\'re now signed in.');
    }
}
