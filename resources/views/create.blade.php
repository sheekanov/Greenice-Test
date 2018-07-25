@extends('layouts.base')

@section('page-title')| Создать место@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <h1 class="hhh">Add Place</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <form id="placeForm" method="POST" action="{{route('store')}}">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="col-lg-8">
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-8">
                            <input type="text" name="address" placeholder="Address" class="form-control" id="address">
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-primary add" id="search">Search</button>
                            <input type="submit" class="btn btn-primary" value ='Save'>
                            <a href="{{route('home')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row  mb-3">
            <div class="col-lg-12" style="color: red; min-height: 1.5em;">{{$message}}</div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div id="map" style="height: 350px;"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <input type="text" form="placeForm" name="lat" placeholder="Latitude" class="form-control" id="lat" style="display: none;">
            </div>
            <div class="col-lg-6">
                <input type="text" form="placeForm" name="long" placeholder="Longitude" class="form-control" id="long" style="display: none;">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsD_g0gXr6Y6Koe3Izsdcxr8raWwXoV1M&callback=initMap">
    </script>

    <script src="{{ asset('js/main.js') }}"></script>
@endsection