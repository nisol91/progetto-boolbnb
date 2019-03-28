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
            $services[] = $apartment->where('services', $input['services']);
            $result[] = $services;

        }



        return response()->json(
            ['success'=>$result,
             'input'=>$input,
            ]
        );
    }

    // public function search(Request $request){

    //     // $input = request()->all();
    //     $user = User::all();
    //     // select user email from database
    //     $data = User::where('email', 'LIKE', $request->email.'%')->get();
            
            
    //     // return response()->json(
    //     // ['success'=>$result,
    //     //  'input'=>$input,
    //     // ]
    // );



}

