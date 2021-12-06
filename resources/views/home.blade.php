<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather Widget</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body class="antialiased">
    <div id="app">
        <weather-widget :current-latitude="{{$latitude}}"
                        :current-longitude="{{$longitude}}"
                        url="{{route('get-current-weather')}}"
                        loader-image="{{asset('loader/loading.gif')}}"
        >

        </weather-widget>
    </div>
    </body>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAItWlkhk_29WuGZ5udToIdprKNm77t7JQ&callback=initMap&libraries=places&v=weekly&channel=2" async></script>--}}
{{--    <script src="{{asset('assets/js/weather.js')}}"></script>--}}

    <script src="{{asset('js/app.js')}}"></script>
{{--    <script>--}}
{{--        var url ="{{route('get-current-weather')}}"--}}
{{--        getWeatherUpdate("{{$latitude}}",{{$longitude}});--}}
{{--    </script>--}}

</html>

