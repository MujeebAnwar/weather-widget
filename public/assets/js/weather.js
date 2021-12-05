
// Google Autocomplete Weather
var measureUnit = 'metric';
var latitude = '';
var longitude = '';
function initMap() {

    const input = document.getElementById("search_input");
    const autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener("place_changed", () => {

        const place = autocomplete.getPlace();

        latitude =place.geometry.location.lat();
        longitude =place.geometry.location.lng()
        $('#loader').removeClass('d-none');
        $('#main-content').addClass('d-none');
        getWeatherUpdate(latitude,longitude)

    });
}

// Reset Button Click

function clickResetButton(lat,long)
{
    $('#search_input').val('');
    $('#loader').removeClass('d-none');
    $('#main-content').addClass('d-none');
    latitude = lat;
    longitude = long;
    measureUnit = 'metric';
    $('#celsius').prop('checked',true)
    getWeatherUpdate(latitude,longitude)
}


// Input Search Box

function inputSearchBox(event,latitude,longitude)
{

    if(!event.value)
    {
        $('#loader').removeClass('d-none');
        $('#main-content').addClass('d-none');
        getWeatherUpdate(latitude,longitude)
    }

}


// Change Unit Function
function changeUnit(event) {

    measureUnit = event.value;
    $('#loader').removeClass('d-none');
    $('#main-content').addClass('d-none');
    getWeatherUpdate(latitude,longitude)
}

// Get Updated Weather

function getWeatherUpdate(lat,long)
{
    latitude = lat;
    longitude = long;
    $.ajax({
        type:'POST',
        url:url,
        dataType:"json",
        data:{
            latitude:latitude,
            longitude:longitude,
            measureUnit : measureUnit
        },
        success:function (response) {
            if(response.status)
            {
                let data = response.data;
                let weather_type = data.weather[0].main;
                let country_title = data.name+' , '+data.sys.country;
                let feels_like = data.main.feels_like;
                let  current_temp = data.main.temp;
                let  min_temp = data.main.temp_min;
                let  max_temp = data.main.temp_max;
                let unit = data.unit;
                let  icon = data.weather[0].icon;
                $('#weather-type').empty().html(weather_type);
                $('#country-title').empty().html(country_title);
                $('#feels-like').empty().html(feels_like+unit);
                $('#current-temp').empty().html(current_temp+unit);
                $('#min-temp').empty().html(min_temp+unit);
                $('#max-temp').empty().html(max_temp+unit);
                $('#wi-con').attr('src','http://openweathermap.org/img/wn/'+icon+'@2x.png');
                $('#loader').addClass('d-none');
                $('#main-content').removeClass('d-none');

            }
        }
    })
}
