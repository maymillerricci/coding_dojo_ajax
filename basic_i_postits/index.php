<?php
	require("connection.php");
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Post-Its</title>
		<link rel="stylesheet" href="postit.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">

			$(document).ready(function() {
				$('#postit_form').submit(function() {				
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data){
							//if there's an error message in a the data array, show the error message
							if(data['error']) {
								$('#error').html(data['error']);
							} else { //otherwise add the new postit note
								$('#postits_wrapper').append("<div class='postit'>" + data['postit'] + "</div>");
								$('#postit_new').val("");
							}
						},
						"json"
					);
					return false;
				});
			});
		</script>
	</head>
	<body>
		<div id="container">
			<h2>My Posts:</h2>
			<form action="process.php" method="post" id="postit_form">
			<!-- display all posts (querying from database) -->
			<div id='postits_wrapper'>
				<?php  
					$query = "SELECT post from POSTS";
					$posts = fetch_all($query);
					foreach($posts as $post)
					{
						echo "<div class='postit'>" . $post['post'] . "</div>";
					}
				?>
			</div> <!-- close postits_wrapper div -->

			<!-- add new post -->
			<div id="new_post">
				<p>Add a note:</p>
				<p id="error"></p>
				<textarea id="postit_new" name="postit_new"></textarea>
				<br>
				<input type="submit" value="Post It!">
			</div> <!-- close new_post div -->
			</form>
		</div> <!-- close container div -->
	</body>
</html>