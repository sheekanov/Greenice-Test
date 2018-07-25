@extends('places-base')

@section('table')
    <table class="table table-hover table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Area</th>
            <th>Distance, kms</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($placesWithDistance as $placeWD)
            <tr id="{{$placeWD['place']->id}}">
                <td>{{$placeWD['place']->address}}</td>
                <td>{{$placeWD['distance']}}</td>
                <td><a class="badge badge-primary" href="{{route('edit' , ['placeId' => $placeWD['place']->id])}}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection