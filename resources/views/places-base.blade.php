@extends('layouts.base')

@section('page-title')| Places @endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <h1 class="hhh">Places</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <form id="placeForm" method="GET" action="{{route('home')}}">
                    <div class="form-row">
                        <div class="col-lg-8">
                            <label for="location">Your location</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-8">
                            <select class="form-control" form="placeForm" name="placeId" id="places" value = '0'>
                                <option value="0" selected="selected">None</option>
                                @foreach($places as $place)
                                    <option value="{{$place->id}}" @if($placeId == $place->id) selected @endif>{{$place->address}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <input type="submit" class="btn btn-primary" value ='Select'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="{{route('create')}}" class="btn btn-primary">Add place</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @yield('table')
            </div>
        </div>
    </div>
@endsection
