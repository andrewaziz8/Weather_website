<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html";  charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Weather App</title>
	<style>
		body{
			background: lightblue;
		}
	</style>
</head>

<body>
	<h1> Hello to my weather website </h1>
	<h3> Enter any city in Egypt to know the weather </h3>
	

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	Choose a City:
	<select name="cities">
		<option value="cairo"> Cairo</option>
		<option value="Giza"> Giza</option>
		<option value="Alexandria"> Alexandria</option>
		<option value="Sharm El Sheikh"> Sharm El Sheikh </option>
		<option value="Hurghada"> Hurghada </option>
		<option value="Port Said"> Port Said </option>
		<option value="Suez"> Suez </option>
		<option value="Mansoura"> Mansoura </option>
		<option value="Sohag"> Sohag</option>
		<option value="Luxor"> Luxor </option>
		<option value="Aswan"> Aswan </option>
	</select>
	<input type="submit" value="Get The Weather">
</form>
<?php
$city="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$city=$_POST['cities'];
	$url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=597a82eb48e544f442ac65ae4621ff53";
	$content = file_get_contents($url);
// Decode JSON data and get temperature value in Kelvin
	//$weather_data=var_dump(json_decode($content,true));
	$weather_data=json_decode($content,true);

	$temp = $weather_data["main"]["temp"];
// Convert temperature from Kelvin to Celsius
	$temp_celsius = $temp - 273.15;
	$temp_max=$weather_data["main"]["temp_max"];
	$temp_max_cel=$temp_max-273.15;
	$temp_min=$weather_data["main"]["temp_min"];
	$temp_min_cel=$temp_min - 273.15;
	$humidity=$weather_data["main"]["humidity"];
	$pressure=$weather_data["main"]["pressure"];
	$sunrise=$weather_data["sys"]["sunrise"];
	$sunset=$weather_data["sys"]["sunset"];
	$sunrise_time=date('H:m:s',$sunrise);
	$sunset_time=date('H:m:s',$sunset);

	echo "The Temperature in $city is: " . $temp_celsius ."°C<br>";
	/* echo "The Maximum Temperature in $city is: " . $temp_max_cel . "°C<br>";
	echo "The Minimum Temperature in $city is: " . $temp_min_cel . "°C<br>"; */
	echo "The Humidity in $city is: " . $humidity . "%<br>";
	echo "The Pressure in $city is: " . $pressure . "mb<br>";
	echo "The sunrise time in $city is: " . $sunrise_time. "<br>";
	echo "The sunset time in $city is: " . $sunset_time. "<br>";
}
?>
</body>
</html>