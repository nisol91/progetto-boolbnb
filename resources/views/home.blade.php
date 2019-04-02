@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="container-fluid">
  @if ($message = Session::get('deleted'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
  @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>i tuoi appartamenti</h1>
                    <a href="{{ route('apartment.create')}}" class="btn btn-secondary">crea nuovo</a>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Address</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Visibility</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartments as $item)
                                <tr>

                                    <td><h4>{{ $item->description }}</h4></td>
                                    <td><h4>{{ $item->address }}</h4></td>
                                    {{-- <td><img src="{{ $item->image }}" alt=""></td> --}}
                                    {{-- <td><img src="{{ asset('storage/' . $item->image) }}" alt=""></td> --}}
                                    @if (strpos( $item->image, 'https') !== false)
                                    <td><img src="{{ $item->image }}" class="card-img-top img_section" alt="..."></td>
                                    @else
                                    <td><img src="{{ asset('storage/' . $item->image) }}" alt=""></td>
                                    @endif
                                    <td><a href="{{ route('apartment.edit', $item->id)}}" class="btn btn-success">modifica</a></td>
                                    <td><a href="{{ route('apartment.show', $item->id) }}" class="btn btn-primary">Show</a></td>
                                    <td><form action="{{ route('apartment.destroy', $item->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form></td>
                                        <td><div class=" {{( $item->visibility == 1 ) ? null : 'hidden'}}"> <h6>Hidden</h6> </div></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
