<?php

use App\Models\Location;
use App\Models\State;
use Illuminate\Database\Seeder;

class UpdateLocationReferenceImportId extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Bihar
        $state = State::find(3);
        $state->refrence_import_id = 5;
        $state->save();

        //HIMACHAL PRADESH
        $state = State::find(8);
        $state->refrence_import_id = 12;
        $state->save();

        //Maharastra
        $state = State::find(2);
        $state->refrence_import_id = 20;
        $state->save();

        //Gujarat
        $state = State::find(1);
        $state->refrence_import_id = 10;
        $state->save();
        //Patna
        $location = Location::find(5);
        $location->refrence_import_id = 100;
        $location->save();
        //Pune
        $location = Location::find(4);
        $location->refrence_import_id = 390;
        $location->save();
        //Mumbai
        $location = Location::find(3);
        $location->refrence_import_id = 381;
        $location->save();
        //Surat
        $location = Location::find(2);
        $location->refrence_import_id = 183;
        $location->save();
        //Ahmedabad
        $location = Location::find(1);
        $location->refrence_import_id = 155;
        $location->save();
    }
}
