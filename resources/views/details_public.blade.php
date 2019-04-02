@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            {{-- <h5>Numero visualizzazioni: {{$apartment->clicks}}</h5> --}}

            <h1>Appartamento con id: {{ $apartment->id }}</h1>
            <h1>Titolo:{{$apartment->description}}</h1>
            <h5>Numero stanze:{{$apartment->rooms_number}}</h5>
            <h5>Numero letti:{{$apartment->beds_number}}</h5>
            <h5>Numero bagni:{{$apartment->baths_number}}</h5>
            <h5>Superficie:{{$apartment->surface}}</h5>
            <h5>Indirizzo: {{$apartment->address}}</h5>
            <h5>Prezzo per notte:{{$apartment->price}}</h5>



            <div class="form-group hidden">
                <label for="address">Indirizzo</label>
                <input type="text" name="address" class="form-control" id="detailsAddress"
                    placeholder="Enter the address" value"">
            </div>

            <div id="my_map_details" style="width: 100%; height: 200px;"></div>

            <div class="coords hidden">

                <div class="lat">
                    <h2>Latitude: </h2>
                    <h4 id="det_lat">{{ $apartment->lat }}</h4>
                </div>
                <div class="lng">
                    <h2>Longitude: </h2>
                    <h4 id="det_lng">{{ $apartment->lng }}</h4>
                </div>
            </div>


            <h5>Services:</h5>
            @foreach ($apartment->services as $item)
            <h5>{{$item->service}}</h5>
            @endforeach
            {{-- <img src="{{ $apartment->image }}" class="card-img-top img_section" alt="...">
            <img src="{{ asset('storage/' . $apartment->image) }}" alt=""> --}}
            @if (strpos( $apartment->image, 'https') !== false)
            <img src="{{ $apartment->image }}" class="card-img-top img_section" alt="...">
            @else
            <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
            @endif
        </div>
    </div>
    <div class="row">
        <form class="form-group" action="{{ route('message.store') }}" method="post">
            @csrf
            <div class="form-group hidden">
                <label for="apartment_id">id</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id"
                    name="apartment_id" value=" {{$apartment->id }} ">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name" name="name">
            </div>
            {{-- <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                    name="email">
            </div> --}}
            <div class="form-group">
                <label for="email">Email address</label>
                <input id="autocomplete_email" type="email" class="form-control" placeholder="name@example.com" name="email" list="email_list" autocomplete="on">
                <datalist id="email_list" > </datalist>
            </div>
            <div class="form-group">
                <label for="body">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
            </div>
            <button class="btn btn-primary" type="submit" id="cercaBtn">Submit</button>
        </form>
    </div>
</div>
@endsection


