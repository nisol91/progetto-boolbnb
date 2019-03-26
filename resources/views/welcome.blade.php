@extends('layouts.app')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
  @endif


<div class="img-wrapper">
    <img class="img-responsive" src="" alt="">
    <div class="container">
    <div class="row">
        <div class="col-md-5">
        <form class="" action="{{ route('filtered') }}">
        @csrf

        <div class="search_wrapper">
            <div class="form-group">
                <label for="address">Indirizzo</label>
                <input type="text" name="address" class="form-control" id="srcAddress" placeholder="Enter the address">
            </div>

              <div class="form-group">
                <label for="">Numero di stanze</label>
                <input type="text" name="rooms_number" placeholder="inserisci quante stanze dovrebbe avere il tuo appartamento" class="form-control" id="numStanze">
              </div>

              <div class="form-group">
                <select class="form-control" name="beds_number"id="numPostiLetto">
                  <option selected>Seleziona numero posti letto</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>

              </div>

              <div class="form-group">
                <select class="form-control" name="range" id='raggio'>
                  <option selected>Seleziona il raggio di distanza</option>
                  <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                  </select>

              </div>

              @foreach ($services as $service)
                <div class="">
                  <input type="checkbox" class="chkServices" name='{{ $service->service }}' value='{{ $service->service }}'>
                  <label>{{$service->service }}</label>
                </div>

              @endforeach

            <button class="btn btn-primary" type="submit" id="cercaBtn">Cerca</button>
        </div>
      {{-- </form> --}}

        </div>
    </div>
</div>
</div>





<div class="container">
  <div class=row>
    <div class="col-12-md">
      <h3>Appartamenti disponibili con una modifica</h3>
    </div>
  </div>
  <div class="row">
  @foreach ($apartments as $item)
      <div class="col-md-3">
          <div class="card">
              <img src="{{ $item->image }}" class="card-img-top img_section" alt="...">
              <div class="card-body">
              <h5 class="card-title"> {{ $item->description }} </h5>
              <p class="card-text">{{ $item->address }}</p>
              <a href="{{ route('details.public', $item->id) }}" class="btn btn-primary">Show</a>
              </div>
          </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

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
