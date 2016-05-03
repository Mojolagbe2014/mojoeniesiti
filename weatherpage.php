<script type="text/javascript" src="js/openWeather.js"></script>
<div id="weather_report">
<span class="weatherTitle"></span>
<div class="weatherBody">
<img src="images/preloader.gif" class="weather-icon" alt="Weather Icon" />
<span id="temprature"></span>
<span id="remarks"></span>
<div class="clearfix"></div>
</div>
<div class="param"><strong>Humidity: </strong><em class="weather-humidity"></em>&nbsp;<strong>Wind Speed: </strong><em class="weather-wind-speed"></em></div>
<span style="display:block;padding:0 5px 0 5px; margin-top:5px; text-align:center;font-weight:bold"><a href="<?php echo SITE_URL;?>weather" title="View full forecast">Full Forecast</a></span>
</div>
<script>$(function(){$("#temprature").openWeather({city:"Lagos, NG",descriptionTarget:"#remarks",windSpeedTarget:".weather-wind-speed",minTemperatureTarget:".weather-min-temperature",maxTemperatureTarget:".weather-max-temperature",humidityTarget:".weather-humidity",sunriseTarget:".weather-sunrise",sunsetTarget:".weather-sunset",placeTarget:".weatherTitle",iconTarget:".weather-icon",customIcons:"images/weatherIcons/icons/weather/",success:function(){$(".weather-wrapper").show()},error:function(a){console.log(a)}})});</script>