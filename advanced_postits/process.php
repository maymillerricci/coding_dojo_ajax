<?php
	require("connection.php");

	$data = array(); //initializes empty "data" array

	//NEW_NOTE
	if(isset($_POST['action']) && $_POST['action'] == 'new_note')
		{
		
		//if post-it note is empty, set error message in data array
		if(empty($_POST['new_note_title']))
		{
			$data['error'] = "Please enter a note title to post it.";
		}

		//otherwise add post to database and set content of postit note in data array
		elseif(isset($_POST['new_note_title']))
		{
			$query = "INSERT INTO notes (title, description, created_at) VALUES ('{$_POST['new_note_title']}', '', NOW())";
			mysql_query($query);
			$data['note_title'] = $_POST['new_note_title'];
			$query = "SELECT id from notes ORDER BY created_at DESC LIMIT 1";
			$record = fetch_record($query);
			$data['id'] = $record['id'];
		}	
	}

	//EDIT NOTE
	if(isset($_POST['action']) && $_POST['action'] == 'edit_note')
	{
		$query = "UPDATE notes
					SET description='" . $_POST['note'] . 
					"' WHERE id=" . $_POST['id'];
		echo $query;
		mysql_query($query);
		$data['message'] = 'updated';
	}

	//DELETE NOTE
	if(isset($_POST['action']) && $_POST['action'] == 'delete_note')
	{
		$query = "DELETE FROM notes
					WHERE id=" . $_POST['id'];
		mysql_query($query);
		$data['message'] = 'deleted';
		$data['id'] = $_POST['id'];
	}

	echo json_encode($data); //encode data array into json
?>