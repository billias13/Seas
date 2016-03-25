<?php
//-----------------------------------------------------------------------
function connectToDatabase(){
//-----------------------------------------------------------------------
	
	require("dbInfo.php");
	
	// Opens a connection to server
	$connection=mysql_connect ("localhost", $username, $password);
	if (!$connection) {
	  die("Not connected : " . mysql_error());
	}

	// Set the active database
	$db_selected = mysql_select_db($database, $connection);
	if (!$db_selected) {
	  die ("Can\'t use db : " . mysql_error());
	}

	
	
}

//-----------------------------------------------------------------------
function getPortIDsByName(&$namesArray)
//-----------------------------------------------------------------------
{
	
	$strIn = '';
	
	$last_key = end(array_keys($namesArray));
	foreach ($namesArray as $key => &$value) {
		 if ($key == $last_key) {
			$strIn = $strIn."'".$value."'";
		 }else{
			$strIn = $strIn."'".$value."',";
		 }
	}
	
	$query = 'Select PortID From Ports Where PortName IN ('.$strIn.') ORDER BY FIELD (PortName, '.$strIn.')';


	connectToDatabase();
	
	$result = mysql_query($query);

	if (!$result) {
	  die("Invalid query: " . mysql_error());
	}


	$rows = array();

	// Iterate through the rows, adding XML nodes for each
	while ($row = @mysql_fetch_assoc($result)){
		
	  $rows[] = $row['PortID'];
	  
	}
	
	return $rows;
	
}

//-----------------------------------------------------------------------
function routeIDsToPortNames(&$idsArray)
//-----------------------------------------------------------------------
{
	$strIn = '';
	
	$last_key = end(array_keys($idsArray));
	foreach ($idsArray as $key => &$value) {
		 if ($key == $last_key) {
			$strIn = $strIn.$value;
		 }else{
			$strIn = $strIn.$value.', ';
		 }
	}
	
	$query = 'Select PortName, PortLat, PortLng From Ports Where PortID IN ('.$strIn.') ORDER BY FIELD (PortID, '.$strIn.')';
	
	
	connectToDatabase();


	$result = mysql_query($query);

	if (!$result) {
	  die("Invalid query: " . mysql_error());
	}


	//header("Content-type: text/xml");
	$rows = array();
	$portConnections = array();

	//echo '<br>Follow the route : <br>';
	// Iterate through the rows, adding XML nodes for each
	while ($row = @mysql_fetch_assoc($result)){
		
	  $rows[] = $row;
	  
	  //echo $row['PortName'].' - ';
	  
	}
	
	return $rows;
}
?>