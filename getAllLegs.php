<?php

//-----------------------------------------------------------------------
function getAllLegs()
//-----------------------------------------------------------------------
{
	

	connectToDatabase();

	// Search the rows in the markers table
	$query = "SELECT legs.PortAID, legs.PortBID, legs.RouteID, legs.LegID, ps.PortName AS 'PortNameA' , pb.PortName AS 'PortNameB'  FROM routelegs legs JOIN ports ps ON legs.PortAID = ps.PortID
	 left JOIN ports pb ON legs.PortBID = pb.PortID ORDER BY legs.RouteID";

	$result = mysql_query($query);

	if (!$result) {
	  die("Invalid query: " . mysql_error());
	}


	$rows = array();

	//Generate port connections array as a global scope variable
	$portConnections = array();

	// Iterate through the rows, adding XML nodes for each
	while ($row = @mysql_fetch_assoc($result)){
	
		$rows[] = $row;
   
		$portConnections[] = array($row['PortAID'],$row['PortBID'],$row['LegID'],$row['RouteID'] );
  
	}
	
	return $portConnections;

}
?>
