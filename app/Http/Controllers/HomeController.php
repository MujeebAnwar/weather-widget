<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function index()
    {

        $currentIpData = @unserialize (file_get_contents('http://ip-api.com/php/'));
        $latitude = $currentIpData['lat'];
        $longitude = $currentIpData['lon'];
        return view('home',compact('latitude','longitude'));
    }
}
