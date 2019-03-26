<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ogni utente vede solo i suoi appartamenti
        $chiamata = Apartment::all(); 
        $apartments = $chiamata->where('user_id', \Auth::user()->id);

        return view('home', compact('apartments'));
    }

}
