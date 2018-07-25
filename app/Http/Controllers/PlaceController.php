<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Place;

class PlaceController extends Controller
{
    /*
     * Этот метод отвечает за логику странички со списком всех мест и фильтром-выбором своего города
     */
    public function index(Request $request)
    {
        $places = Place::orderBy('address')->get();
        $placeId = $request->placeId;

        if (is_null($placeId) | $placeId == 0) { //если в гет-запросе нам не пришел выбранный город или выбран город "None", то рендерим отсортированный по алфавиту список без расстояний
            return view('places-nolocation', ['places' => $places, 'placeId' => 0]);
        } else { //если пользователь выбрал город, то подготавливаем и рендерим список отсортированный по расстояниям
            $currentPlace = Place::find($placeId);
            $placesWithDistance = collect([]);

            foreach ($places as $place) {
                $distance = $this->haversine($currentPlace, $place); //функция haversine вычисляет расстояние между точками на сфере, она определена дальше по коду
                $placesWithDistance->push(['distance' => $distance, 'place' => $place]);
            }

            return view('places-location', [
                'placesWithDistance' => $placesWithDistance->sortBy('distance')->all(),
                'places' => $places,
                'placeId' => $placeId
            ]);
        }
    }

    /*
     * Этот метод просто рендерит страничку создания нового места
     */
    public function create()
    {
        return view('create', ['message' => '']);
    }

    /*
     * Этот отвечает за логику добавления нового места в БД
     */
    public function store(Request $request)
    {
        $rules = array(
            'lat' => 'required',
            'long' => 'required'
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) { //координаты должны быть заданы, иначе вернем сообщение об ошибке
            $message = 'Choose existing place';
            return view('create', ['message' => $message]);
        } else {
            $place = new Place();
            $place->lat = $request->lat;
            $place->lng = $request->long;
            $place->address = $request->address;
            $place->save();
            return redirect()->route('home');
        }
    }
    /*
     * Этот метод просто рендерит страничку редактирования места
     */
    public function edit($placeId)
    {
        $place = Place::find($placeId);

        return view('edit', [
            'place' => $place,
            'message' => ''
        ]);
    }
    /*
     * Этот метод отвечает за логику сохранения места в БД после редактирования
     */
    public function update($placeId, Request $request)
    {
        $place = Place::find($placeId);

        $rules = array(
            'lat' => 'required',
            'long' => 'required'
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {  //координаты должны быть заданы, иначе вернем сообщение об ошибке
            $message = 'Choose existing place';
            return view('edit', [
                'place' => $place,
                'message' => $message
            ]);
        } else {
            $place->lat = $request->lat;
            $place->lng = $request->long;
            $place->address = $request->address;
            $place->save();
            return redirect()->route('home');
        }
    }

    /*
     * Этот метод отвечает за удаление мест из БД
     */
    public function delete($placeId)
    {
        $place = Place::find($placeId);
        $place->delete();

        return redirect()->route('home');
    }

    /*
     * Это вспомогательный метод для расчета расстояния между двумя местами по их координатам.
     * В нем реализовано вычисления по формуле гаверсинуса (расстояние между двумя точками на сфере).
     */
    protected function haversine(Place $place1, Place $place2)
    {
        $r = 6356.863; //радиус Земли в км

        $coords1Rad = array( //преобразование градусов в радианы
            'lat' => deg2rad($place1->lat),
            'lng' => deg2rad($place1->lng)
        );

        $coords2Rad = array( //преобразование градусов в радианы
            'lat' => deg2rad($place2->lat),
            'lng' => deg2rad($place2->lng)
        );

        $distance = 2*$r*asin( //просто длинная формула...
                sqrt(
                    pow(sin(($coords2Rad['lat'] - $coords1Rad['lat'])/2),2) +
                    cos($coords1Rad['lat'])*cos($coords2Rad['lat'])*pow(sin(($coords2Rad['lng']-$coords1Rad['lng'])/2),2)
                )
            );

        return round($distance);
    }
}
