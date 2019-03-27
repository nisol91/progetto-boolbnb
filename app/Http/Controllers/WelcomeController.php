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
        public function details_public($id)
    {
        $apartment = Apartment::findOrFail($id); // ricerca tramite ID se non trovato errore 404 return view('ospiti.show', compact('ospiteCercato'));


        return view('details_public', compact('apartment', 'visitors'));
    }
}
