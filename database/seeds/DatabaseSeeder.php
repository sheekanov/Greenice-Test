<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //подключаем файл areas.php, берем оттуда массив с данными и записываем их в БД
        include 'areas.php';

        foreach ($areas as $address => $coords) {
            $place = new \App\Place();
            $place->address = $address;
            $place->lat = $coords['lat'];
            $place->lng = $coords['long'];
            $place->save();
        }
    }
}
