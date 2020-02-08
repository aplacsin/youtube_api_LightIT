<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Get all favorite posts by user
     *
     * @return Response
     */
    /* Likes Video Page */
    public function myFavorites()
    {
        if (Auth::check()) {
            $myFavorites = Auth::user()->favorites;
            return view('youtube.likes', compact('myFavorites'));
        }
        else {
            return redirect('login')->with('status', 'Сначала нужно авторизоваться на сайте');
        }
    }
}