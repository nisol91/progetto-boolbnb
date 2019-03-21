@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    sei nella dashboard del proprietario
                    <h1>i tuoi appartamenti</h1>
                    @foreach ($apartments as $item)
                       <h1>{{ $item->description }}</h1>
                        <h1>{{ $item->rooms_number }}</h1>
                        <h1>{{ $item->beds_number }}</h1>

                    @endforeach
                    <a href="{{ route('apartment.create')}}" class="btn">crea</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
