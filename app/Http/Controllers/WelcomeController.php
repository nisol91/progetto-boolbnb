<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class WelcomeController extends Controller
{
    public function index_public()
    {
        $apartments = Apartment::all();
        $services = Service::all();
        // dd($apartments);
        return view('welcome', compact('apartments', 'services'));
    }
}
