<?php
	require("connection.php");

	$data = array();
	$data['html'] = null;
	$from_date = date('Y-m-d', strtotime($_POST['from_date']));
	$to_date = date('Y-m-d', strtotime($_POST['to_date']));

	//query for if no from or to date
	if(!($_POST['from_date']) && !($_POST['to_date']))
	{
		$query = "select * 
					from leads
					where (first_name like '{$_POST['name']}%' or last_name like '{$_POST['name']}%')";
	}
	//query for if from date but no to date
	elseif(($_POST['from_date']) && !($_POST['to_date']))
	{
		$query = "select * 
					from leads
					where (first_name like '{$_POST['name']}%' or last_name like '{$_POST['name']}%')
						and (registered_datetime>='{$from_date}')";
	}
	//query for if to date but no from date
	elseif(!($_POST['from_date']) && ($_POST['to_date']))
	{
		$query = "select * 
					from leads
					where (first_name like '{$_POST['name']}%' or last_name like '{$_POST['name']}%')
						and (registered_datetime<='{$to_date}')";
	}
	//query for if both from and to dates
	elseif(($_POST['from_date']) && ($_POST['to_date']))
	{
		$query = "select * 
					from leads
					where (first_name like '{$_POST['name']}%' or last_name like '{$_POST['name']}%')
						and (registered_datetime>='{$from_date}' and registered_datetime<='{$to_date}')";
	}

	//figure out how many users and how many pages of 10 results each
	$users = fetch_all($query);
	$num_pages = ceil(count($users)/10);
	$initial_query = $query;

	//display heading, depending on whether there are results
	if($num_pages)
	{
		$html = "<p>" . count($users) . " results total. 10 results per page. Pages:</p><ul>";
	}
	else
	{
		$html = "<p>0 results.</p>";
	}
	$html .= "<ul>";

	//create pagination link bar
	for ($i=1; $i<=$num_pages; $i++)
	{
		$html .= "<li><a class='link' id='link" . ($i) . "' href='#{$i}'>" . ($i) . "    " . "</a></li>";
	}
	$html .= "</ul>";

	//loop through results adding a new div of a new table for every set of 10 results
	for ($i=0; $i<$num_pages; $i++)
	{ 
		$limit = " limit " . ($i*10) . ", 10";
		$new_query = $initial_query . $limit;
		$users = fetch_all($new_query);

		//add table heading
		$html .= "
			<div class='page' id='page" . ($i+1) . "'>
				<p>Results " . ($i*10+1) . " - " . (($i+1)*10) . ": </p>
				<table>
					<thead>
						<tr>
							<th>leads_id</th>
							<th>first_name</th>
							<th>last_name</th>
							<th>registered_datetime</th>
							<th>email</th>
						</tr>
					</thead>
					<tbody>";
					//add table body - looping through set of 10 results and adding 1 row per result
					foreach($users as $user)
					{
						$html .= "
						<tr>
							<td>{$user['leads_id']}</td>
							<td>{$user['first_name']}</td>
							<td>{$user['last_name']}</td>
							<td>{$user['registered_datetime']}</td>
							<td>{$user['email']}</td>
						</tr>
					";
					}

			//end table
			$html .= "
					</tbody>
				</table>
			</div>
			";
	}

	//add html & # of pages to data array and encode in json to send to ajax
	$data['html'] = $html;
	$data['num_pages'] = $num_pages;
	echo json_encode($data);
?>