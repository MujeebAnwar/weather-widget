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
    <section class="vh-100">
        <div class="container py-5 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 ">
                    <div id="loader">
                        <img id="loading-image"   src="{{asset('loader/loading.gif')}}"/>
                    </div>
                    <div id="main-content" class="d-none">
                        <h3 class="mb-4 pb-2 fw-normal">Check the weather</h3>
                        <div class="input-group rounded mb-3">
                            <input type="search" oninput='inputSearchBox(this,"{{$latitude}}","{{$longitude}}")' id="search_input" class="form-control rounded" placeholder="Enter Your Location" aria-label="Search"
                                   aria-describedby="search-addon" />
                            <button type="button" class="btn btn-warning" id="reset" onclick='clickResetButton("{{$latitude}}","{{$longitude}}")'>Reset </button>
                        </div>

                        <div class="mb-4 pb-2">
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="inlineRadioOptions"
                                    id="celsius"
                                    value="metric"
                                    onchange="changeUnit(this)"
                                    checked
                                />
                                <label class="form-check-label" for="inlineRadio1">Celsius</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="inlineRadioOptions"
                                    id="fahrenheit"
                                    onchange="changeUnit(this)"
                                    value="imperial"
                                />
                                <label class="form-check-label" for="inlineRadio2">Fahrenheit</label>
                            </div>
                        </div>
                        <div class="card shadow-0 border">
                            <div class="card-body p-4">

                                <h5 class="mb-1 sfw-normal" id="country-title"></h5>
                                <p class="mb-2" >Current temperature: <strong id="current-temp"></strong></p>
                                <p>Feels like: <strong id="feels-like"></strong></p>
                                <p>Max: <strong id="max-temp"></strong>, Min: <strong id="min-temp"></strong></p>
                                <div class="d-flex flex-row align-items-center">
                                    <p class="mb-0 me-4" id="weather-type"></p>
                                    <img id="wi-con" src="" alt="Weather icon">
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAItWlkhk_29WuGZ5udToIdprKNm77t7JQ&callback=initMap&libraries=places&v=weekly&channel=2" async></script>
    <script src="{{asset('assets/js/weather.js')}}"></script>
    <script>
        var url ="{{route('get-current-weather')}}"
        getWeatherUpdate("{{$latitude}}",{{$longitude}});
    </script>

</html>

