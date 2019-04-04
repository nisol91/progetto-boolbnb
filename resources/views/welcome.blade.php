@extends('layouts.app')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif


<div class="img-wrapper">
    {{-- <img class="img-responsive" src="https://hdqwalls.com/download/crater-lake-oregon-ty-2560x1440.jpg" alt=""> --}}
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="search_wrapper">
                    <h1 id="main_title">Prenota case ed esperienze uniche.</h1>
                    <div class="up_form">
                        <div class="app_address">

                            <div class="form-group">
                                <label for="address">Dove vuoi alloggiare?</label>
                                <input type="text" name="address" class="form-control" id="srcAddress"
                                    placeholder="Inserisci l'indirizzo">
                            </div>



                            {{-- //geocomplete --}}
                            <div id="my_map_search" style="width: 100%; height: 200px;"></div>
                            <div class="details_search hidden">
                                <label class="" for="lat">Map latitude</label>
                                <input type="number" name="lat" class="form-control " id="latitude_search"
                                    placeholder="map lat">
                                <label class="" for="lng">Map longitude</label>
                                <input type="number" name="lng" class="form-control " id="longitude_search"
                                    placeholder="map lng">

                                {{-- Latitude:     <div data-geo="lat"></div>
                            Longitude:    <div data-geo="lng"></div>
                            Address:      <div data-geo="formatted_address"></div>
                            Country Code: <div data-geo="country_short"></div> --}}
                            </div>
                            {{-- --- --}}
                        </div>

                        <div class="other_info">

                            <div class="form-group">
                                <label for="your_address">Dove ti trovi?</label>
                                <input type="text" name="your_address" class="form-control" id="srcyourAddress"
                                    placeholder="Inserisci la tua posizione attuale">
                            </div>

                            <div class="form-group hidden">
                                <label class="" for="insert_lat">Insert latitude</label>
                                <input type="number" name="insert_lat" class="form-control " id="insert_lat"
                                    placeholder="insert your lat">
                                <label class="" for="insert_lng">Insert longitude</label>
                                <input type="number" name="insert_lng" class="form-control " id="insert_lng"
                                    placeholder="insert your lng">
                            </div>



                            <div class="form-group">
                                <label for="">Numero di stanze</label>
                                <input type="number" name="rooms_number"
                                    placeholder="inserisci quante stanze dovrebbe avere il tuo appartamento"
                                    class="form-control" id="numStanze">
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="beds_number" id="numPostiLetto">
                                    <option selected value="">Seleziona numero posti letto</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <select class="form-control" name="range" id='raggio'>
                                    <option selected value="">Seleziona il raggio di distanza</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="70">70</option>
                                    <option value="80">80</option>
                                    <option value="90">90</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                    <option value="2000">2000</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <select class="form-control" name="price" id='prezzo'>
                                    <option selected value="">Seleziona il prezzo per notte</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="70">70</option>
                                    <option value="80">80</option>
                                    <option value="90">90</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                    <option value="2000">2000</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn_services" type="submit" id="cercaServices">Seleziona i servizi che vorresti</button>
                    <div class="down_form_services hidden">


                        @foreach ($services as $service)
                        <div class="servizi hidden">
                            <input type="checkbox" class="chkServices" name='{{ $service->service }}'
                                value='{{ $service->service }}' id="servizi">
                            <label>{{$service->service }}</label>
                        </div>

                        @endforeach

                    </div>
                    <button class="btn btn-primary" type="submit" id="cercaBtn">Cerca</button>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- appartamenti in evidenza --}}
<div class="container evidenza hidden">
    <div class="row titl">
        <div class="col-12-md">
            <h3>Appartamenti in evidenza</h3>
        </div>
    </div>
    <div class="row appa_evidenza">
        @foreach ($apartments as $item)
        @if ($item->sponsor == 1 || $item->sponsor == 2 || $item->sponsor == 3)

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 {{( $item->visibility == 1 ) ? 'hidden' : null}} carta_app">
            <div class="card sponsor appa">
                <h5 class="card-title identificativo_app_welcome hidden">{{$item->id}}</h5>
                @if (strpos( $item->image, 'https') !== false)
                <img src="{{ $item->image }}" class="card-img-top img_section" alt="...">
                @else
                <img src="{{ asset('storage/' . $item->image) }}" alt="">
                @endif
                <div class="card-body">

                    <h5 class="card-title desc"> {{ $item->description }} </h5>
                    <p class="card-text">{{ $item->address }}</p>
                    <p class="card-text prices">{{ $item->price }} €</p>

                </div>
                <a href="{{ route('details.public', $item->id) }}" class="btn btn-primary">Show</a>
            </div>
        </div>
        @endif
        @endforeach

    </div>
</div>

{{-- container per template handlebars --}}
<div class="container filtered hidden">
    <div class="row titl">
        <div class="col-12-md">
            <h3>Appartamenti filtrati</h3>
        </div>
    </div>
    <div class="row appa_filtered">

    </div>
</div>



<div class="container appa_all">
    <div class="row titl">
        <div class="col-12-md">
            <h3>Tutti gli appartamenti</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($apartments as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 {{( $item->visibility == 1 ) ? 'hidden' : null}} carta_app">
            <div class="card appa">
                <h5 class="card-title identificativo_app_welcome hidden">{{$item->id}}</h5>
                @if (strpos( $item->image, 'https') !== false)
                <img src="{{ $item->image }}" class="card-img-top img_section" alt="...">
                @else
                <img src="{{ asset('storage/' . $item->image) }}" alt="">
                @endif
                <div class="card-body">

                    <h5 class="card-title desc"> {{ $item->description }} </h5>
                    <p class="card-text">{{ $item->address }}</p>
                    <p class="card-text prices">{{ $item->price }} €</p>

                </div>
                <a href="{{ route('details.public', $item->id) }}" class="btn btn-primary">Show</a>
            </div>
        </div>
        @endforeach
    </div>
</div>





{{-- template handlebars --}}
<script id="handlebars-template" type="text/x-handlebars-template">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 contenitore_appa" id="container-card" dist="@{{ dist }}">
        <div class="card appa" >
        <img src="@{{ source }}" class="card-img-top img_section" alt="...">
            <div class="card-body">
            <h5 class="card-title"> @{{ desc }}</h5>
            <p class="card-text">@{{ address }}</p>
            <p class="card-text prices">@{{ prezzo }} €</p>
            <p class="card-text">@{{ dist }}km</p>
        </div>
        <a href="details/@{{ id_ }}" class="btn btn-primary">Show</a>
    </div>
</script>



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

@endsection
