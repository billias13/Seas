<?php


	connectToDatabase();

	// Search the rows in the markers table
	$query = "SELECT * FROM Ports ORDER BY PortName";

	$result = mysql_query($query);

	if (!$result) {
	  die("Invalid query: " . mysql_error());
	}

	//Init output
	$rows = array();
	// Iterate through the rows, adding XML nodes for each
	while ($row = @mysql_fetch_assoc($result)){
	  $rows[] = $row;
		
	}
	
//Print the json encoded array of Ports
print json_encode($rows);

?>
