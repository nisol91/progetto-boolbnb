<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Service;
use App\User;
use App\Message;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $services = Service::all();
        $users = User::all();


        return view('create', compact('services', 'users'));
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

        // dd($data);

        $validatedData = $request->validate([
            'description' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]+$/'],
            'rooms_number' => ['required', 'integer', 'min:0', 'max:200'],
            'price' => ['required', 'integer', 'min:0', 'max:2000'],

            'beds_number' => ['required', 'integer', 'min:0', 'max:200'],
            'baths_number' => ['required', 'integer', 'min:0', 'max:200'],
            'surface' => ['required', 'integer', 'min:0', 'max:5000'],
            'address' => ['required', 'string', 'max:255'],
            'lat' => [],
            'lng' => [],
            'services' => [],
            'user_id'=>[],
        ]);


        // dd($validatedData);

        $image = Storage::disk('public')->put('apartaments_images', $data['image']);
        $validatedData['image'] = $image;

        $validatedData['user_id'] = \Auth::user()->id;
        // anche se ho fatto la one to many, comunque lo user lo devo passare ai validatedData.
        //Lo posso fare o cosi da backend(scelta consigliata), oppure con un input nascosto da frontend (scelta sconsigliata)


        $newApartment = new Apartment;
        $newApartment->fill($validatedData);



        $newApartment->save();

        $newApartment->services()->sync($validatedData['services']);


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
        $request = Message::all();

        $messages = $request->where('apartment_id', $apartment['id']);

        return view('show', compact('apartment', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();


        return view('edit', compact('apartment', 'services'));
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
        $data = $request->all();

        $validatedData = $request->validate([
            'description' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]+$/'],
            'rooms_number' => ['required', 'integer', 'min:0', 'max:200'],
            'price' => ['required', 'integer', 'min:0', 'max:2000'],

            'beds_number' => ['required', 'integer', 'min:0', 'max:200'],
            'baths_number' => ['required', 'integer', 'min:0', 'max:200'],
            'surface' => ['required', 'integer', 'min:0', 'max:5000'],
            'address' => ['required', 'string', 'max:255'],
            'lat' => [],
            'lng' => [],
            'services' => [],
            'user_id'=>[],
            'visibility'=>['integer', 'min:0', 'max:1'],
        ]);

        $image = Storage::disk('public')->put('apartaments_images', $data['image']);
        $validatedData['image'] = $image;

        $apartment->update($validatedData);

        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('home') ->with('deleted','Apartment deleted');
    }
}
