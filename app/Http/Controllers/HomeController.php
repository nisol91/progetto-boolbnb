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


        if (!empty($input['address'])) {
            $address = $apartments->where('address', $input['address']);
            $result[] = $address;
        }

        if (!empty($input['rooms_number'])) {
            $rooms_number = $apartments->where('rooms_number', $input['rooms_number']);
            $result[] = $rooms_number;
        }

        if (!empty($input['beds_number'])) {
            $beds_number = $apartments->where('beds_number', $input['beds_number']);
            $result[] = $beds_number;
        }

        if (!empty($input['services'])) {
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

        foreach ($result as $value) {
            foreach ($value as $item) {
                $final[] = $item;
            }
        }
        $final_results = array_unique($final);


        return response()->json(
            ['success'=>$result,
             'input'=>$input,
            'final'=>$final_results,

            //  'servizi_appa'=>$servizi_appa,
            //  'input_services'=>$input['services'],
            ]
        );
    }



}
