<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index_public()
    {
        $apartments = Apartment::all();
        $appa_arr = $apartments;

        $services = Service::all();



//###########prove di consolelog#####################
// $appi = $apartments->where('sponsor', 2);
// foreach ($appi as $apartment) {
//      $date = $apartment->app_date;
//      $ora = Carbon::now();
//     $diff = $ora->diffInSeconds($date);
//     if ($diff > 24) {
//         // dd('maggiore');
//         $apartment->sponsor = 0;
//         $apartment->save();
//     }
// }

//         foreach ($apartments as $apartment) {
//     # code...
//     $ap = $apartment->where('services', ['Facilis.']);
//     var_dump($ap);
// }
        // $apartments = Apartment::orderBy('id')->get();
        // foreach ($apartments as $apartment) {
        //     // dd($apartments->services());
        // }
        // foreach ($apartments as $item) {
        //     foreach ($item->services as $value) {
        //         $servizi_appa[] = $value;
        //     }
        //     dd($servizi_appa);
        // }
        // dd($servizi_appa);
        // dd($apartments);
        // dd($services);
        // foreach ($apartments as $item) {
        //     var_dump($item->image);
        // }

        return view('welcome', compact('apartments', 'services'));
    }


        public function details_public($id)
    {
        $apartment = Apartment::findOrFail($id); // ricerca tramite ID se non trovato errore 404 return view('ospiti.show', compact('ospiteCercato'));

        $data = getdate();
        $mese = $data['month'];
        // $mese = "October";


        if ($mese == "January") {
            $apartment->increment('clicks_gen');
        }
         if ($mese == "February") {
            $apartment->increment('clicks_feb');
        }
         if ($mese == "March") {
            $apartment->increment('clicks_mar');
        }
         if ($mese == "April") {
            $apartment->increment('clicks_apr');
        }
         if ($mese == "May") {
            $apartment->increment('clicks_mag');
        }
         if ($mese == "June") {
            $apartment->increment('clicks_giu');
        }
         if ($mese == "July") {
            $apartment->increment('clicks_lug');
        }
         if ($mese == "August") {
            $apartment->increment('clicks_ago');
        }
         if ($mese == "September") {
            $apartment->increment('clicks_set');
        }
         if ($mese == "October") {
            $apartment->increment('clicks_ott');
        }
         if ($mese == "November") {
            $apartment->increment('clicks_nov');
        }
         if ($mese == "December") {
            $apartment->increment('clicks_dic');
        }

        $apartment->update();

        return view('details_public', compact('apartment'));
    }
}
