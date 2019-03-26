@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12">
            <h1>Appartamento con id: {{ $apartment->id }}</h1>
                <h1>Titolo:{{$apartment->description}}</h1>
                <h5>Numero stanze:{{$apartment->rooms_number}}</h5>
                <h5>Numero letti:{{$apartment->beds_number}}</h5>
                <h5>Numero bagni:{{$apartment->baths_number}}</h5>
                <h5>Superficie:{{$apartment->surface}}</h5>
                <h5>Indirizzo: {{$apartment->address}}</h5>
                <img src="{{ $apartment->image }}" class="card-img-top img_section" alt="...">
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
            </div>
        </div>
        <div class="row">
            <form class="form-group" action="{{ route('message.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group hidden">
                    <label for="apartment_id">id</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id" name="apartment_id" value=" {{$apartment->id }} ">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name" name="name">
                </div>
                    <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
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
