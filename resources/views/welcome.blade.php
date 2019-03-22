@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group ">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="indirizzo" placeholder="Enter the address">
            </div>
            <select class="custom-select">
                <option selected>Open this select menu</option>
                <option value="1">One</>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <select class="custom-select">
                <option selected>Open this select menu</option>
                <option value="1">One</>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <label for="customRange2">Example range</label>
            <input type="range" class="custom-range" min="0" max="5" id="customRange2">
            <div class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-deck">
                <div class="card"> <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer"> <small class="text-muted">Last updated 3 mins ago</small> </div>
                </div>
                <div class="card"> <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional
                            content.</p>
                    </div>
                    <div class="card-footer"> <small class="text-muted">Last updated 3 mins ago</small> </div>
                </div>
                <div class="card"> <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content. This card has even longer content than the first to show that equal
                            height action.</p>
                    </div>
                    <div class="card-footer"> <small class="text-muted">Last updated 3 mins ago</small> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
