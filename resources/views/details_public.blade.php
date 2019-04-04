@extends('layouts.app')
@section('content')
<div class="container main_i">
    <div class="details__title row">
        <div class="col-md-12">
            {{-- <h5>Numero visualizzazioni: {{$apartment->clicks}}</h5> --}}
            <h1>Appartamento {{ $apartment->id }}</h1>
        </div>
    </div>
    <div class="details__image row">
        <div class="col-md-12 img">
            {{-- <img src="{{ $apartment->image }}" class="card-img-top img_section" alt="...">
            <img src="{{ asset('storage/' . $apartment->image) }}" alt=""> --}}
            @if (strpos( $apartment->image, 'https') !== false)
            <img class='img-responsive' src="{{ $apartment->image }}" class="card-img-top img_section" alt="...">
            @else
            <img class='img-responsive' src="{{ asset('storage/' . $apartment->image) }}" alt="">
            @endif
        </div>
    </div>
    <hr>
    <div class="details__main__content row">
        <div class="col-md-6">
            {{-- <h5>Numero visualizzazioni: {{$apartment->clicks}}</h5> --}}
            <h2>{{$apartment->description}}</h2>
            <ul class="lista_cose">
                <li>Stanze {{$apartment->rooms_number}}</li>
                <li>Posti Letto {{$apartment->beds_number}}</li>
                <li>Bagni {{$apartment->baths_number}}</li>
                <li>Superficie {{$apartment->surface}}</li>
                <li>Prezzo per notte {{$apartment->price}} &euro;</li>
            </ul>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, ullam! Saepe quas a esse eos doloremque rem, eius quam incidunt quo assumenda ullam repellat eum, facere odit quis. Minus, necessitatibus!</p>
        </div>
        <div class="offset-md-2 col-md-4">
            <h5>Servizi:</h5>
            <ul>
                @foreach ($apartment->services as $item)
                <li>{{$item->service}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="details__location col-md-4">
            <h2>Ubicazione:</h2>
            <span>Indirizzo: {{$apartment->address}}</span>
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
        </div>
        <div class="details__form offset-md-2 col-md-5 offset-md-1">
            <h5>Scrivi al proprietario</h5>
            <form class="form-group" action="{{ route('message.store') }}" method="post">
                @csrf
                <div class="form-group hidden">
                    <label for="apartment_id">id</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id"
                        name="apartment_id" value=" {{$apartment->id }} ">
                </div>
                <div class="details__form form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Scrivi qui il tuo nome" name="name">
                </div>
                <div class="details__form form-group">
                    <label for="email">Email</label>
                    <input id="autocomplete_email" type="email" class="form-control" placeholder="name@email.com" name="email" list="email_list" autocomplete="on">
                    <datalist id="email_list"> </datalist>
                </div>
                <div class="details__form form-group">
                    <label for="body">Messaggio</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body" placeholder="Scrivi qui il tuo messaggio"></textarea>
                </div>
                <button class="btn btn-primary send_btn" type="submit" id="cercaBtn">Invia</button>
            </form>
        </div>
    </div>
    <hr>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="footer_list">
                    <li>Airbnb</li>
                    <li>Opportunità di lavoro</li>
                    <li>Stampa</li>
                    <li>Condizioni</li>
                    <li>Aiuto</li>
                    <li>Diversità e appartenenza</li>
                    <li>Informazioni di contatto</li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer_list">
                    <li>Scopri</li>
                    <li>Affidabilità e sicurezza</li>
                    <li>Crediti di viaggio</li>
                    <li>Cittadino di Airbnb</li>
                    <li>Viaggi di lavoro</li>
                    <li>Guide</li>
                    <li>Airbnbmag</li>
                    <li>Eventi</li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer_list">
                    <li>Ospita</li>
                    <li>Perché affittare</li>
                    <li>Ospitalità</li>
                    <li>Ospitare responsabilmente</li>
                    <li>Community Center</li>
                    <li>Offri un'esperienza</li>
                    <li>Open Homes</li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer_social">
                    <li>
                        <i class="fab fa-facebook-square"></i>
                        <i class="fab fa-twitter-square"></i>
                        <i class="fab fa-instagram"></i>
                    </li>
                    <li>Termini</li>
                    <li>Privacy</li>
                    <li>Mappa del sito</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <small>© Boolbnb, Inc.</small>
            </div>
        </div>
    </div>
</footer>






</div>
{{-- container --}}
@endsection


