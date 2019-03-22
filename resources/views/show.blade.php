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
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
            </div>
        </div>
    </div>
@endsection
