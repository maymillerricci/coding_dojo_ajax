<?php
	require("connection.php");
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Ajax Table</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/hot-sneaks/jquery-ui.css" type="text/css" media="all" />
		<link rel="stylesheet" href="table.css">
		<script type="text/javascript">
			$(document).ready(function() {
				
				//datepicker
				$('.datepicker').datepicker();

				//defines function to submit form
				function formSubmit() {
					$('#test_form').submit();
				};
				
				//makes form submit on keyup within name search box
				$('#search_text').keyup(function(){
					formSubmit();
				});

				//makes form submit on keyup or changing (via datepicker mouse click) the from date
				$('#search_from_date').on({
					keyup: formSubmit,
					change: formSubmit
				});

				//makes form submit on keyup or changing (via datepicker mouse click) the to date
				$('#search_to_date').on({
					keyup: formSubmit,
					change: formSubmit
				});

				//actions when submitting form
				$('#test_form').submit(function() {
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data){
							//query db and put results into html
							$('#results').html(data['html']);
							//pagination - set page links and hide all but first page
							for(var i=2; i<=data['num_pages']; i++) {
								$('#page' + i).hide();
							};
							$('#link1').addClass('clicked');
							//pagination - upon clicking a link #, hide all pages and show just that page #
							$('.link').click(function() {
								$('.link').removeClass('clicked'); 
								$(this).addClass('clicked'); 
								var link = (this.id);
								var page = link.replace("link", "page");
								$('.page').hide();
								$('#' + page).show();
							});
						},
						"json"
					);
					return false;
				});

				//submits form on first page load so results show up even at start
				formSubmit();
			});
		</script>
	</head>
	<body>
		<form id="test_form" action="process.php" method="post">
			Name: <input type="text" name="name" id="search_text">
			From: <input type="text" class="datepicker" name="from_date" id="search_from_date">
			To: <input type="text" class="datepicker" name="to_date" id="search_to_date">
		</form>
		<div id="results"></div>
	</body>
</html>