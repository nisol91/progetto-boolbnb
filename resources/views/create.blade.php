@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Aggiungi nuova categoria</h1>
                <form class="form-group" action="{{ route('apartment.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="" placeholder="Enter description">
                    </div>
                    <div class="form-group">
                        <label for="rooms_number">Number of rooms</label>
                        <input type="number" name="rooms_number" class="form-control" id="" placeholder="Enter the number of rooms">
                    </div>
                    <div class="form-group">
                        <label for="beds_number">Number of beds</label>
                        <input type="number" name="beds_number" class="form-control" id="" placeholder="Enter the number of beds">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Create new category">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
