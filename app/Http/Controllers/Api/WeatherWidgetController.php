<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherWidgetController extends Controller
{
    //

    public function getCurrentWeather(Request $request)
    {

        try {
            $url ='api.openweathermap.org/data/2.5/weather?lat='.$request->latitude.'&lon='.$request->longitude.'&appid=02e0d729f23f89e6e72432b0638c57b2&units='.$request->measureUnit;

            $response = Http::get($url);

            $data = $response->json();

            $data['unit'] = $request->measureUnit =='metric' ? ' °C' : ' °F';

            return response()->json([
                'status' => true,
                'data' =>$data
            ]);
        }catch (\Exception $exception)
        {

            return response()->json([
                'status' => false,
                'message' => 'Something Went Wrong Please Try Later'
            ]);
        }

    }
}
