<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //vedi HomeController
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $services = [
            'doccia',
            'wifi',
            'finestra',
            'cristo',
            'madonna'
        ];

        return view('create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $validatedData = $request->validate([
            'description' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]+$/'],
            'rooms_number' => ['required', 'integer', 'max:200'],
            'beds_number' => ['required', 'integer', 'max:200'],
            'baths_number' => ['required', 'integer', 'max:200'],
            'surface' => ['required', 'integer', 'max:5000'],
            'address' => ['required', 'string', 'max:255'],
        ]);


        $newApartment = new Apartment;
        $newApartment->fill($validatedData);



        $newApartment->save();


        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
