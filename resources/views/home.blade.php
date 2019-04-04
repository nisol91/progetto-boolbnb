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
            <div class="card " id="table_container">
                <div class="card-header">Ciao {{ Auth::user()->name }}, ecco i tuoi appartamenti</div>
                <a href="{{ route('apartment.create')}}" class="btn btn-secondary">Aggiungi nuovo appartamento</a>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Description</th>
                                <th scope="col">Address</th>
                                <th scope="col" class="">Image</th>
                                <th scope="col" class="">Actions</th>
                                <th scope="col" class=""></th>
                                <th scope="col" class=""></th>
                                <th scope="col" class=""></th>



                                <th scope="col" class="">Visibility</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartments as $item)
                            <tr id="tabella_media_query">
                                <div class="desc_img">

                                    <td>
                                        <h4>{{ $item->description }}</h4>
                                    </td>
                                    <td>
                                        <h4>{{ $item->address }}</h4>
                                    </td>
                                    {{-- <td><img src="{{ $item->image }}" alt=""></td> --}}
                                    {{-- <td><img src="{{ asset('storage/' . $item->image) }}" alt=""></td> --}}
                                    @if (strpos( $item->image, 'https') !== false)
                                    <td><img src="{{ $item->image }}" class="card-img-top img_section " alt="..."></td>
                                    @else
                                    <td><img src="{{ asset('storage/' . $item->image) }}"
                                            class="card-img-top img_section " alt=""></td>
                                    @endif
                                </div>


                                <td><a href="{{ route('apartment.edit', $item->id)}}"
                                        class="btn btn-success">modifica</a></td>
                                <td><a href="{{ route('apartment.show', $item->id) }}" class="btn btn-primary">Show</a>
                                </td>
                                <td>
                                    <form action="{{ route('apartment.destroy', $item->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                </td>
                                <td><a href="{{ route('payment.index', $item->id) }}"
                                        class="btn btn-primary">Sponsor</a></td>
                                <td>
                                    <div class=" {{( $item->visibility == 1 ) ? null : 'hidden'}}">
                                        <h6>Hidden</h6>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                    <div class="table_media">

                            @foreach ($apartments as $item)
                            <tr id="tabella_media_query">
                                <div class="desc_img">


                                        <h4 id="h4_i">{{ $item->description }}</h4>


                                        <h4>{{ $item->address }}</h4>

                                    {{-- <img src="{{ $item->image }}" alt=""> --}}
                                    {{-- <img src="{{ asset('storage/' . $item->image) }}" alt=""> --}}
                                    @if (strpos( $item->image, 'https') !== false)
                                    <img src="{{ $item->image }}" class="card-img-top img_section " alt="...">
                                    @else
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                            class="card-img-top img_section" alt="">
                                    @endif
                                </div>


                                <a href="{{ route('apartment.edit', $item->id)}}"
                                        class="btn btn-success">modifica</a>
                                <a href="{{ route('apartment.show', $item->id) }}" class="btn btn-primary">Show</a>


                                    <form action="{{ route('apartment.destroy', $item->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>

                                <a href="{{ route('payment.index', $item->id) }}"
                                        class="btn btn-primary">Sponsor</a>

                                    <div class=" {{( $item->visibility == 1 ) ? null : 'hidden'}}">
                                        <h6>Hidden</h6>
                                    </div>


                            </tr>
                            @endforeach
                    </div>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
