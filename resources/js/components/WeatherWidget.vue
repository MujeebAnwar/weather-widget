<template>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 ">

                    <div id="loader" :class="{'d-none':isVisibleData}">
                        <img id="loading-image"   :src="loaderImage"/>
                    </div>
                    <div id="main-content" :class="{'d-none':!isVisibleData}">
                        <h3 class="mb-4 pb-2 fw-normal">Check the weather</h3>
                        <div class="input-group rounded mb-3">
                            <input type="search"  id="search_input" class="form-control rounded" placeholder="Enter Your Location" aria-label="Search"
                                   aria-describedby="search-addon" @input="handleInputSearchBox" :value="locationValue" ref="origin" />
                            <button type="button" class="btn btn-warning" @click="handleResetButtonClick" id="reset" >Reset </button>
                        </div>
                        <div class="mb-4 pb-2">
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="inlineRadioOptions"
                                    id="celsius"
                                    value="metric"
                                    @change="handleChangeUnit"
                                    :checked="measureUnit == 'metric'"
                                />
                                <label class="form-check-label" for="celsius">Celsius</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="inlineRadioOptions"
                                    id="fahrenheit"
                                    @change="handleChangeUnit"
                                    value="imperial"
                                    :checked="measureUnit == 'imperial'"

                                />
                                <label class="form-check-label" for="fahrenheit">Fahrenheit</label>
                            </div>
                        </div>
                        <div class="card shadow-0 border">
                            <div class="card-body p-4">

                                <h5 class="mb-1 sfw-normal" id="country-title">{{countryTitle}}</h5>
                                <p class="mb-2" >Current temperature: <strong id="current-temp">{{currentTemp}}</strong></p>
                                <p>Feels like: <strong id="feels-like"></strong>{{feelsLike}}</p>
                                <p>Max: <strong id="max-temp">{{maxTemp}}</strong>, Min: <strong id="min-temp">{{minTemp}}</strong></p>
                                <div class="d-flex flex-row align-items-center">
                                    <p class="mb-0 me-4" id="weather-type">{{weatherType}}</p>
                                    <img id="wi-con" :src="icon" alt="Weather icon">
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    </section>

</template>

<script>
    export default {

        props:{
            currentLatitude : Number,
            currentLongitude : Number,
            url : String,
            loaderImage:String
        },
        data(){
            return {
                measureUnit : 'metric',
                latitude : this.currentLatitude,
                longitude : this.currentLongitude,
                weatherData : {},
                countryTitle : null,
                currentTemp:null,
                feelsLike:null,
                maxTemp:null,
                minTemp:null,
                weatherType:null,
                icon:null,
                isVisibleLoader:true,
                isVisibleData :false,
                locationValue : '',

            }

        },
        mounted() {
            this.getWeatherUpdate();
            this.initGoogleMap();
        },
        methods:{

            // get Weather Data against latitude and longitude
            async getWeatherUpdate()
            {
                var weatherData = {latitude: this.latitude,longitude: this.longitude,measureUnit : this.measureUnit};
                await axios.post(this.url,weatherData)
                    .then(response => (this.weatherData = response.data.data));
                this.countryTitle  = this.weatherData.name+' , '+this.weatherData.sys.country;
                this.currentTemp = this.weatherData.main.temp + this.weatherData.unit;
                this.feelsLike = this.weatherData.main.feels_like + this.weatherData.unit;
                this.maxTemp = this.weatherData.main.temp_max + this.weatherData.unit;
                this.minTemp = this.weatherData.main.temp_min + this.weatherData.unit;
                this.weatherType = this.weatherData.weather[0].main;
                this.icon = 'http://openweathermap.org/img/wn/'+this.weatherData.weather[0].icon+'@2x.png';
                this.isVisibleData = true;
            },

            // Change Unit Method
            handleChangeUnit(event) {
                this.measureUnit = event.target.value;
                this.isVisibleData = false;
                this.getWeatherUpdate()
            },

            // Attach google map autocomplete api
            initGoogleMap()
            {
                const autocomplete = new google.maps.places.Autocomplete(this.$refs["origin"]);
                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();
                    this.latitude =place.geometry.location.lat();
                    this.longitude =place.geometry.location.lng();
                    this.locationValue = place.formatted_address
                    this.isVisibleData = false;
                    this.getWeatherUpdate();
                })
            },

            // Handle Reset Button Click
            handleResetButtonClick()
            {
                this.latitude = this.currentLatitude;
                this.longitude = this.currentLongitude;
                this.measureUnit = 'metric';
                this.isVisibleData = false;
                this.locationValue = '';
                this.measureUnit = 'metric';
                this.getWeatherUpdate();
            },

            // Handle Location Search Box

             handleInputSearchBox(event)
             {
                 if(!event.target.value)
                 {
                     this.latitude = this.currentLatitude;
                     this.longitude = this.currentLongitude;
                     this.locationValue = '';
                     this.isVisibleData = false;
                     this.getWeatherUpdate()
                 }

             }
        }
    }
</script>
