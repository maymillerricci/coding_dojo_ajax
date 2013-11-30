<!-- List of things to improve "someday":
-Edit note title
-Way to deal with long title or description input
-Way to not repeat whole div class note content twice, in script for appended one and in html for all
-Make page update after note is edited w/out reloading page
-Note doesn't always update when edited the first time
-Apostrophe, etc. input
-Delete confirmation message
But for now I just need to move on... :-)
 -->

<?php
	require("connection.php");
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Post-Its</title>
		<link rel="stylesheet" href="notes.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">

			$(document).ready(function() {
				//hide edit boxes for notes
				$('.note_description_edit').hide();

				//submit new note form
				$(document).on('submit', '#new_note_form', function() {			
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							//if there's an error message in a the data array, show the error message
							if(data['error']) {
								$('#error').html(data['error']);
							} else { //otherwise add the new postit note
								$('#all_notes').append(
									"<div class='note' id='note" + data['id'] + "'>" + 
										"<div class='note_title'>" + data['note_title'] + "</div>" + 
										"<div class='note_description' id=" + data['id'] + ">" + "</div>" + 
										"<div class='note_description_edit' id=" + data['id'] + ">" + 
											"<form action='process.php' method='post' class='edit_note_form'>" + 
												"<textarea>" + "</textarea>" +
												"<input type='hidden' name='id' value=" + data['id'] + ">" + 
												"<input type='hidden' name='action' value='edit_note'>" +
											"</form>" + 
										"</div>" + 
										"<form action='process.php' method='post' class='delete_note_form'>" + 
											"<input type='hidden' name='id' value=" + data['id'] + ">" + 
											"<input type='hidden' name='action' value='delete_note'>" +
											"<input type='submit' class='delete_button' value='Delete'>" + 
										"</form>" + 
									"</div>");
								$('.note_description_edit').hide();
								$('#new_note_title').val("");
							}
						},
						"json"
					);
					return false;
				});

				//on clicking the description, changes to an edit box
				$(document).on('click', '.note_description', function() {
					var num = ($(this).attr('id'));
					$('.note_description#' + num).hide();
					$('#' + num + '.note_description_edit').show();
				});

				//defines what to do when edit form is submitted
				$(document).on('submit', '.edit_note_form', function() {			
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							alert('form');
						},
						"json"
					);
					return false;
				});

				//when delete form is submitted
				$(document).on('submit', '.delete_note_form', function() {	
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							$('#note' + data['id']).remove();
						},
						"json"
					);
					return false;
				});

				//calls submit function when note is edited
				$(document).on('change', '.note_description_edit', function() {			
					$('.edit_note_form').submit();
					var num = ($(this).attr('id'));
					$('.note_description#' + num).show();
					$('#' + num + '.note_description_edit').hide();
					location.reload(); //I should find a better way to do this
					});

				//hides edit box and shows note box when click out of edit box (blur)
				$(document).on('blur', '.note_description_edit textarea', function() {			
					var num = $(this).parent().parent().attr('id')
					$('.note_description#' + num).show();
					$('#' + num + '.note_description_edit').hide();
				});

			});
		</script>
	</head>
	<body>
		<div id="container">
			<h2>Notes</h2>
			<p>Double click on a note to edit it.</p>
			
			<!-- display all notes (querying from database) -->
			<div id='all_notes'>
				<?php  
					$query = "SELECT id, title, description FROM notes";
					$notes = fetch_all($query);
						foreach($notes as $note)
						{
							echo 
								"<div class='note' id='note"  . $note['id'] . "'>" . 
									"<div class='note_title'>" . $note['title'] . "</div>" . 
									"<div class='note_description' id=" . $note['id'] . ">" . $note['description'] . "</div>" . 
									"<div class='note_description_edit' id=" . $note['id'] . ">" . 
										"<form action='process.php' method='post' class='edit_note_form'>" . 
											"<textarea name='note'>" . $note['description'] . "</textarea>" .
											"<input type='hidden' name='id' value=" . $note['id'] . ">" . 
											"<input type='hidden' name='action' value='edit_note'>" .
										"</form>" . 
									"</div>" . 
									"<form action='process.php' method='post' class='delete_note_form'>" . 
										"<input type='hidden' name='id' value=" . $note['id'] . ">" . 
										"<input type='hidden' name='action' value='delete_note'>" .
										"<input type='submit' class='delete_button' value='Delete'>" . 
									"</form>" . 
								"</div>";
						}
				?>
			</div> <!-- close all_notes div -->

			<!-- add new note -->
			<div id="new_note">
				<form action="process.php" method="post" id="new_note_form">
					<p>Add a title for a new note:</p>
					<p id="error"></p>
					<input type="text" id="new_note_title" name="new_note_title" placeholder="New note title">
					<input type="hidden" name="action" value="new_note">
					<br>
					<input type="submit" value="Add Note!">
				</form>
			</div> <!-- close new_note div -->
		</div> <!-- close container div -->
	</body>
</html>