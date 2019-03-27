@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
            <h1>Appartamento con id: {{ $apartment->id }}</h1>
                <h1>{{$apartment->description}}</h1>
                <h5>{{$apartment->rooms_number}}</h5>
                <h5>{{$apartment->beds_number}}</h5>
                <h5>{{$apartment->baths_number}}</h5>
                <h5>{{$apartment->surface}}</h5>
                <h5>{{$apartment->address}}</h5>
                <h5>Prezzo per notte:{{$apartment->price}}</h5>


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

            <div class="col-12">

                @foreach ($messages as $item)
                <div class="messaggio">
                    <h1>Messaggio</h1>
                    <h6> {{ $item->body }} </h6>
                    <h5> from: {{ $item->email }} </h5>

                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
