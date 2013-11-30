<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Directions</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#get_directions").submit(function() {
					$.get(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							var directions_array = (data['routes'][0]['legs'][0]['steps']);
							var directions_list = "";
							for(x in directions_array) {
								directions_list = directions_list + "<p>" + (Number(x)+1) + ". " + directions_array[x]['html_instructions'] + "</p>";
							};
							$('#directions').html(directions_list);
						},
						"json"
					);
					return false;
				});
			});
		</script>
	</head>
	<body>
		<form id="get_directions" action="http://maps.googleapis.com/maps/api/directions/json" method="get">
			From: <input type="text" name="origin">
			To: <input type="text" name="destination">
			<input type="hidden" name="sensor" value="false">
			<input type="submit" value="Get Directions!">

			<div id="directions"></div>
		</form>
	</body>
</html>