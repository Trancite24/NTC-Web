<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Journey;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nics= DB::Table('journey')->select('nic')->distinct()->get()->count();
        $routes=DB::Table('journey')->select('routeNo')->distinct()->get()->count();
        $journeys= DB::Table('journey')->select('journeyId')->distinct()->get()->count();
        return view('home')->with('nics',$nics)->with('routes',$routes)->with('journeys',$journeys);;
    }
}
