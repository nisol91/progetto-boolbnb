@extends('layouts.app')
@section('content')
    <div class="container main_ii">
        <div class="row">
            <div class="col-xs-12 col-lg-6">
            {{-- <h1>Appartamento con id: {{ $apartment->id }}</h1> --}}
                <h1>{{$apartment->description}}</h1>
                <h5>Numero di stanze: {{$apartment->rooms_number}}</h5>
                <h5>Numero di letti: {{$apartment->beds_number}}</h5>
                <h5>Numero di bagni: {{$apartment->baths_number}}</h5>
                <h5>Superficie: {{$apartment->surface}}</h5>
                <h5>Indirizzo: {{$apartment->address}}</h5>
                <h5>Prezzo per notte: {{$apartment->price}}</h5>


                <h2>Servizi:</h2>
                @foreach ($apartment->services as $item)
                    <h5>{{$item->service}}</h5>
                @endforeach
            </div>
            <div class="col-xs-12 col-lg-6">
                            <h2>Foto</h2>

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
        {{-- <h5>Numero visualizzazioni: {{$apartment->clicks_apr}}</h5> --}}
                    <h2>Visualizzazioni per mese</h2>

            <input type="text" name="description" class="form-control hidden" id="visite_gen" placeholder="Enter description" value="{{$apartment->clicks_gen}}">
            <input type="text" name="description" class="form-control hidden" id="visite_feb" placeholder="Enter description" value="{{$apartment->clicks_feb}}">
            <input type="text" name="description" class="form-control hidden" id="visite_mar" placeholder="Enter description" value="{{$apartment->clicks_mar}}">
            <input type="text" name="description" class="form-control hidden" id="visite_apr" placeholder="Enter description" value="{{$apartment->clicks_apr}}">
            <input type="text" name="description" class="form-control hidden" id="visite_mag" placeholder="Enter description" value="{{$apartment->clicks_mag}}">
            <input type="text" name="description" class="form-control hidden" id="visite_giu" placeholder="Enter description" value="{{$apartment->clicks_giu}}">
            <input type="text" name="description" class="form-control hidden" id="visite_lug" placeholder="Enter description" value="{{$apartment->clicks_lug}}">
            <input type="text" name="description" class="form-control hidden" id="visite_ago" placeholder="Enter description" value="{{$apartment->clicks_ago}}">
            <input type="text" name="description" class="form-control hidden" id="visite_set" placeholder="Enter description" value="{{$apartment->clicks_set}}">
            <input type="text" name="description" class="form-control hidden" id="visite_ott" placeholder="Enter description" value="{{$apartment->clicks_ott}}">
            <input type="text" name="description" class="form-control hidden" id="visite_nov" placeholder="Enter description" value="{{$apartment->clicks_nov}}">
            <input type="text" name="description" class="form-control hidden" id="visite_dic" placeholder="Enter description" value="{{$apartment->clicks_dic}}">

        <div class="row">
            <div class="col-12">
                <div class="grafico">
                  <canvas class="line-chart" id="my_chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
