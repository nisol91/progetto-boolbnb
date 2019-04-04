
@extends('layouts.app')
@section('content')
{{-- errori --}}
    <div class="container">
        @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
       @endif
<!-- se ci sono campi vuoti -->
       @if (!empty($message))
       <div class="alert alert-success">
           <ul>
               <li>{{ $message }}</li>
           </ul>
       </div>
       @endif
{{-- ----- --}}
        <div class="row">
            <div class="col-12">
                <h1>Edit Apartment</h1>
                <form class="form-group" action="{{ route('apartment.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="visibility">
                        <label class="form-check-label" for="visibility">
                            Hidden
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" id="defaultCheck1" name="visibility">
                        <label class="form-check-label" for="visibility">
                            Show
                        </label>
                    </div>
                    {{-- <div class="form-group">
                        <label for="visibility">Hidden</label>
                    <input type="text" name="visibility" class="form-control" id="" placeholder="Enter description" value="{{$apartment->visibiity}}">
                    </div> --}}
                    <div class="form-group">
                        <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" id="" placeholder="Enter description" value="{{$apartment->description}}">
                    </div>
                     <div class="form-group">
                        <label for="price">Price in euros</label>
                        <input type="number" name="price" class="form-control" id="" placeholder="Enter the price" value="{{$apartment->price}}">
                    </div>
                    <div class="form-group">
                        <label for="rooms_number">Number of rooms</label>
                        <input type="number" name="rooms_number" class="form-control" id="" placeholder="Enter the number of rooms" value="{{$apartment->rooms_number}}">
                    </div>
                    <div class="form-group">
                        <label for="beds_number">Number of beds</label>
                        <input type="number" name="beds_number" class="form-control" id="" placeholder="Enter the number of beds" value="{{$apartment->beds_number}}">
                    </div>
                    <div class="form-group">
                        <label for="baths_number">Number of baths</label>
                        <input type="number" name="baths_number" class="form-control" id="" placeholder="Enter the number of baths" value="{{$apartment->baths_number}}">
                    </div>
                    <div class="form-group">
                        <label for="surface">Surface [square meters]</label>
                        <input type="number" name="surface" class="form-control" id="" placeholder="Enter the surface" value="{{$apartment->surface}}">
                    </div>
                    <div class="form-group ">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="indirizzo" placeholder="Enter the address" value="{{$apartment->address}}">
                        <div id="my_map"></div>
                        <div class="details">
                          <label for="lat">latitude</label>
                          <input type="text" name="lat" class="form-control" id="latitude" placeholder="lat">
                          <label for="lng">longitude</label>
                          <input type="text" name="lng" class="form-control" id="longitude" placeholder="long">

                        {{-- Latitude:     <div data-geo="lat"></div>
                        Longitude:    <div data-geo="lng"></div>
                        Address:      <div data-geo="formatted_address"></div>
                        Country Code: <div data-geo="country_short"></div> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="">
                        {{-- <input type="submit" value="Upload Image" name="submit"> --}}
                    </div>
                            @foreach ($services as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="defaultCheck1" name="services[]" {{(!empty($item->service)) ? 'checked' : null }}>
                                <label class="form-check-label" for="services[]">
                                    {{$item->service}}
                                </label>
                            </div>
                            @endforeach
                    <div class="form-group">
                        <input class="btn btn-primary create_edit_btn" type="submit" value="Update new apartment">
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
