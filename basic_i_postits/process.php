<?php
	require("connection.php");
	$data = array(); //initializes empty "data" array
	//if post-it note is empty, set error message in data array
	if(empty($_POST['postit_new']))
	{
		$data['error'] = "Please enter a note to post it.";
	}
	//otherwise add post to database and set content of postit note in data array
	elseif(isset($_POST['postit_new']))
	{
		$query = "INSERT INTO posts (post, created_at) VALUES ('{$_POST['postit_new']}', NOW())";
		mysql_query($query);
		$data['postit'] = $_POST['postit_new'];
		// $data['status'] = true;
	}	
	echo json_encode($data); //encode data array into json
?>