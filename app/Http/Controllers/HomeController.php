<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Service;
use App\User;

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
        // $this->middleware('auth');
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

    //autocompletamento mail
    public function autocomplete() {
        return response()->json(User::pluck('email'), 200);
    }



        public function ajaxRequestPost(Request $request)
    {
        $input = request()->all();


        $apartments = Apartment::orderBy('created_at');


        //per contare quanti filtri ho usato
        $filters_number = [];

        if (!empty($input['address'])) {
            $filters_number[] = 1;
            $apartments = $apartments->where('address', $input['address']);
        }

        if (!empty($input['rooms_number'])) {
            $filters_number[] = 1;
            $apartments = $apartments->where('rooms_number', $input['rooms_number']);
        }

        if (!empty($input['beds_number'])) {
            $filters_number[] = 1;
            $apartments = $apartments->where('beds_number', $input['beds_number']);
        }

        if (!empty($input['price'])) {
            $filters_number[] = 1;
            $apartments = $apartments->where('price', $input['price']);
        }

        if (!empty($input['insert_lat']) && !empty($input['insert_lng'])) {
            $filters_number[] = 1;
            //se inserisco lat e long prendo tutti gli appa (ovvero non scrivo niente, lascio $apartments->get() senza filtri where),
            //poi li filtro con js
        }



        if (!empty($input['services'])) {
            $filters_number[] = 1;
            $services = $input['services'];

            foreach ($services as $service) {
            $apartments = $apartments->whereHas('services', function($q) use ($service) {
                        $q->where('service', '=', $service);
                    });
                }

        }

        $final = $apartments->get();
        //FILTRO: non prendo subito gli appartamenti dal db, ma li filtro di volta in volta(cosi mi prende solo gli appartamenti che matchano tutti i campi di ricerca inseriti)
        // e poi li prendo alla fine con questo get().

        return response()->json(
            ['success'=>$final,
            'input'=>$input,
            'filters'=>count($filters_number),
            ]
        );
    }



}
