<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Weather</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#get_weather").submit(function() {
					$.get(
						$(this).attr('action')+"?callback=?",
						$(this).serialize(),
						function(data) {
							var weather_data = data['data']['current_condition'][0];
							$('#weather_listing').html(
								"<h2>Weather for: " + $('#city option:selected').attr('id') + "</h2>" +
								"<p>Current Temp F: " + weather_data['temp_F'] + " degrees</p>" +
								"<p>Current Temp C: " + weather_data['temp_C'] + " degrees</p>" +
								"<p>Current Windspeed: " + weather_data['windspeedMiles'] + " MPH</p>" +
								"<p>Weather Description: " + weather_data['weatherDesc'][0].value + "</p>")
						},
						"json"
					);
					return false;
				});
			});
		</script>
	</head>
	<body>
		<h2>The Coding Dojo Weather Report!</h2>
		<form id="get_weather" action="http://api.worldweatheronline.com/free/v1/weather.ashx" method="get">
			<select id="city" name="q">
				<option value="94043" id="Mountain View, CA">Mountain View, CA</option>
				<option value="94065" id="Redwood City, CA">Redwood City, CA</option>
				<option value="02458" id="Newton, MA">Newton, MA</option>
				<option value="96960" id="Marshall Islands">Marshall Islands</option>
				<option value="04941" id="Freedom, ME">Freedom, ME</option>
				<option value="19081" id="Swarthmore, PA">Swarthmore, PA</option>
			</select>
			<input type="hidden" name="key" value="jtpc4myth9fwxjgwz9fh5fw5">
			<input type="hidden" name="format" value="json">
			<input type="submit" value="Get Weather!">

			<div id="weather_listing"></div>
		</form>
	</body>
</html>