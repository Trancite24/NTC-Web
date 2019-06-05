<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobileController extends Controller
{
    //

    public function mobilePage()
    {

        //TODO get the unique nics, trip_ids, routes from database and set to the variables;
        $nics = [];
        $trip_ids = [];
        $routes = [];

        return view('mobile.mobile_data')->with('nics',$nics)->with('trip_ids', $trip_ids)->with('routes',$routes);
    }

    public function getJourneyDetails(Request $request){
        //        search parameters route_id, nic of surveyor, trip_id and date search should be performed on journey and busstop models.
        // When writing queries use only the eloquent. *Don't write sql - ever*
        // Eloquent Models are already set correctly (Journey and Busstop )
        // When there is a confusion about the query, always use ' php artisan tinker' test the query there. no need to run it on the web to test.
        // TODO send a post request through ajax to this method,
        // 1. add the route in routes
        // ajax call needs to be sent for each on change event of the input variables.
        // in each call all 4 parameters needs to be checked, and send them once. Check for not selected ones and remove them from the query. Write the query in steps with if conditions on the search parameters, that will help.
        // 2. implement the ajax call in the mobile_data.blade.php file
        // 3. make sure you add   - '_token': $('meta[name=csrf-token]').attr('content') as a parameter to ajax call
        // 4. return the data in json format - https://stackoverflow.com/questions/31865493/responsejson-laravel-5-1
        // 5. Decode the json and display it on the map
        // When displaying use markers for busstops and add the details on marker tooltip
    }
}
