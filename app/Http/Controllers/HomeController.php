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





        public function ajaxRequestPost(Request $request)
    {
        $input = request()->all();

        $apartments = Apartment::all();
        $services = Service::all();

        $filters_number = [];

        if (!empty($input['address'])) {
            $filters_number[] = 1;
            $address = $apartments->where('address', $input['address']);
            $result[] = $address;
        }

        if (!empty($input['rooms_number'])) {
            $filters_number[] = 1;


            $rooms_number = $apartments->where('rooms_number', $input['rooms_number']);
            $result[] = $rooms_number;
        }

        if (!empty($input['beds_number'])) {
            $filters_number[] = 1;


            $beds_number = $apartments->where('beds_number', $input['beds_number']);
            $result[] = $beds_number;
        }

        if (!empty($input['services'])) {
            $filters_number[] = 1;


            foreach ($apartments as $item) {
                $servizi_appa = [];
                foreach ($item->services as $value) {
                    $servizi_appa[] = $value->service;
                }
                if ($input['services'] == $servizi_appa) {
                    $services_filtered[] = $item;
                    // $result[] = $services_filtered;
                } else {
                    foreach ($input['services'] as $value) {
                        if (in_array($value, $servizi_appa)) {
                        $services_filtered[] = $item;
                        }
                    }
                }
            }

        $result[] = array_unique($services_filtered);

        }

        $final = [];
        foreach ($result as $value) {
            foreach ($value as $item) {
                $final[] = $item;
            }
        }

        //ogni volta che una casella di filtro non e vuota aggiungo un elemento al filters_number
        //conto quindi quanti filtri ci sono.
        //a questo punto se un appa compare tante volte quanti sono i filtri allora va bene

        // $final_results = array_unique($final);


        return response()->json(
            ['success'=>$result,
             'input'=>$input,
             'filters'=>count($filters_number),
             'final'=>$final,
             // 'final_1'=>$final_results,

            //  'servizi_appa'=>$servizi_appa,
            //  'input_services'=>$input['services'],
            ]
        );
    }



}
