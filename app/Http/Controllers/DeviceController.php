<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    //

    public function GPSPage(Request $request){

        $routeNo = null;
        $nic = null;
        $journeyID = null;
        $fromDate = null;
        $toDate = null;

        $params = $this->getParams($routeNo,$nic,$journeyID,$fromDate,$toDate);

//        var_dump($params);
        return view('device.gps_device')->with($params);
    }

    public function getParams($routeNo,$nic,$journeyID,$fromDate,$toDate){

        $uniqueParamsJI = DB::table('DEVICE_JOURNEY_INFO')->select('journeyId')->distinct();
        $uniqueParamsRN = DB::table('DEVICE_JOURNEY_INFO')->select('routeNo','fromName','toName')->distinct();
        $uniqueParamsNIC = DB::table('DEVICE_JOURNEY_INFO')->select('nic')->distinct();
        if($routeNo != null){
            $uniqueParamsJI = $uniqueParamsJI->where('routeNo','=',$routeNo);
            $uniqueParamsNIC = $uniqueParamsNIC->where('routeNo','=',$routeNo);
        }
        if ($journeyID != null){
            $uniqueParamsRN = $uniqueParamsRN->where('journeyId','=',$journeyID);
            $uniqueParamsNIC = $uniqueParamsNIC->where('journeyId','=',$journeyID);
        }
        if($nic != null){
            $uniqueParamsJI = $uniqueParamsJI->where('nic','=',$nic);
            $uniqueParamsRN = $uniqueParamsRN->where('nic','=',$nic);
        }
        if($fromDate != null){
            $uniqueParamsJI = $uniqueParamsJI->whereDate('date','>=',$fromDate);
            $uniqueParamsRN = $uniqueParamsRN->whereDate('date','>=',$fromDate);
            $uniqueParamsNIC = $uniqueParamsNIC->whereDate('date','>=',$fromDate);
        }

        if($toDate != null){
            $uniqueParamsJI = $uniqueParamsJI->whereDate('date','<=',$toDate);
            $uniqueParamsRN = $uniqueParamsRN->whereDate('date','<=',$toDate);
            $uniqueParamsNIC = $uniqueParamsNIC->whereDate('date','<=',$toDate);
        }

        $journeyIDs = $uniqueParamsJI->get();
        $routes = $uniqueParamsRN->get();
        $nics = $uniqueParamsNIC->get();

        return ['journeyIDs'=> $journeyIDs, 'routes'=>$routes,'nics'=>$nics];
    }

    public function refresh(Request $request){

        $routeNo = $request->route;
        $nic = $request->nic;
        $journeyID = $request->journey_id;
        $fromDate = $request->start_date;
        $toDate = $request->end_date;

        $fromDate = date_create_from_format('D M d Y H:i:s e+',$fromDate);
        $toDate = date_create_from_format('D M d Y H:i:s e+',$toDate);

        $params = $this->getParams($routeNo,$nic,$journeyID,$fromDate,$toDate);
        return $params;
    }
    public function getJourneyData(Request $request){

        $routeNo = $request->route;
        $nic = $request->nic;
        $journeyID = $request->journey_id;
        $fromDate = $request->start_date;
        $toDate = $request->end_date;
        $isBusStop = $request->busstops;

        $fromDate = date_create_from_format('D M d Y H:i:s e+',$fromDate);
        $toDate = date_create_from_format('D M d Y H:i:s e+',$toDate);

        $journeyQuery = DB::table('DEVICE_JOURNEY_INFO')->leftJoin('DEVICE_GPS_DATA','DEVICE_JOURNEY_INFO.journeyId','=','DEVICE_GPS_DATA.journeyId');

        if ($routeNo != null){
            $journeyQuery->where('routeNo','=',$routeNo);
        }
        if ($nic != null){
            $journeyQuery->where('nic','=',$nic);
        }
        if ($journeyID != null){
            $journeyQuery->where('DEVICE_JOURNEY_INFO.journeyId','=',$journeyID);
        }
        if ($fromDate != null){
            $journeyQuery->whereDate('date','>=',$fromDate);
        }
        if ($toDate != null){
            $journeyQuery->whereDate('date','<=',$toDate);
        }

        if ($isBusStop == "true"){
            $journeyQuery->where('isBusStop','=',"1");
        }
        $results = $journeyQuery->get();

//        error_log($results);

        return ["journeys"=>$results];
    }

}
