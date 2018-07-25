@extends('places-base')

@section('table')
    <table class="table table-hover table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Area</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($places as $place)
            <tr id="{{$place->id}}">
                <td>{{$place->address}}</td>
                <td>{{$place->lat}}</td>
                <td>{{$place->lng}}</td>
                <td><a class="badge badge-primary" href="{{route('edit' , ['placeId' => $place->id])}}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection