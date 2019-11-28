<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Journey;

class MobileController extends Controller
{
    //

    public function mobilePage()
    {

        //TODO get the unique nics, trip_ids, routes from database and set to the variables;
        $nics= DB::Table('journey')->select('nic')->distinct()->get();
        $trip_ids = DB::Table('journey')->select('journeyId','fromName','toName')->distinct()->get();
        // $trip_ids =Journey::with('busstops')->select('journeyId')->distinct()->get();
        $dates=DB::Table('journey')->select('date')->distinct()->get();
        $routes =DB::Table('journey')->select('routeNo')->distinct()->get();

        return view('mobile.mobile_data')->with('nics',$nics)->with('trip_ids', $trip_ids)->with('routes',$routes)->with('dates',$dates);

    }

    public function getJourneyDetails(Request $request){
        $routeId = $request->routeId;
        $nic = $request->nic;
        $date = $request->date;
        $tripId= $request->tripId;
        $query=Journey::with('busstops');
        if ($nic!="Surveyors NIC" && $nic!="") {
            $query=$query->where('nic',$nic);
        }
        if ($routeId!="Route" && $routeId!="") {
            $query=$query->where('routeNo',$routeId);
        }
        if ($date!="Date" && $date!="") {
            $query=$query->where('date',$date);
        }
        if ($tripId!="Trip Id" && $tripId!="") {
            $query=$query->where('journeyId',$tripId);
        }

        $query = $query->orderBy('record_no');
//        $res=$query->get();
        // var_dump("test "+$routeId);
        return json_encode([

        'nic'=>$query->select('nic')->distinct()->get(),
        'routes'=>$query->select('routeNo')->distinct()->get(),
        'dates'=>$query->select('date')->distinct()->get(),
        'trips'=>$query->select('journeyId','fromName','toName')->distinct()->get()

        ]);

        // $df= DB::Table('journey')->select('nic')->distinct()->get();

        //search parameters route_id, nic of surveyor, trip_id and date search should be performed on journey and busstop models.
        // When writing queries use only the eloquent.* Don't write sql - ever*
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
    public function refresh(Request $request){

        $nics= DB::Table('journey')->select('nic')->distinct()->get();
        $trip_ids = DB::Table('journey')->select('journeyId','fromName','toName')->distinct()->get();
        $dates=DB::Table('journey')->select('date')->distinct()->get();
        $routes =DB::Table('journey')->select('routeNo')->distinct()->get();
        return json_encode([
            'nic'=>$nics,
            'routes'=>$routes,
            'dates'=>$dates,
            'trips'=>$trip_ids
        ]);
    }
}
