<?php 

include("dijkstra.php"); 
include("getPortNamesByID.php");
include("getAllLegs.php");

	$portConnections = getAllLegs();
	
	//print json_encode($portConnections);

	//Stupid but works (Pousti Sarafi):
	//Get port names a strings, find the equivalent ids as integers
	//using the database, and proceed to route finding
	$fromClass = $_POST['PortA']; 
	$toClass = $_POST['PortB']; 
	$a = array();
	$a[] = $fromClass;
	$a[] = $toClass;

	
	$ids = getPortIDsByName($a);

	$fromClass = $ids[0];
	$toClass = $ids[1];

	// I is the infinite distance. 
	define('I',1000); 

	//Initialize the array that will store port connections 
	// RouteID, LegID, PortA, PortB, PortNameA, PortNameB etc
	$portConnectionsMat = array(); 

	// Read in the islands and push them into the map as ids (integers)
	for ($i=0,$m=count($portConnections); $i<$m; $i++) { 

		$x = $portConnections[$i][0]; 
		$y = $portConnections[$i][1]; 
		$c = $portConnections[$i][2]; 
		$portConnectionsMat[$x][$y] = $c; 
		$portConnectionsMat[$y][$x] = $c; 
		
	} 

	//To fix : Matrix width must correspond to the total number of unique port ids
	// Size of the matrix - useless after all
	$matrixWidth = 4; 

	// ensure that the distance from a port to itself is always zero 
	for ($i=0; $i < $matrixWidth; $i++) { 
		for ($k=0; $k < $matrixWidth; $k++) { 
			if ($i == $k) $portConnectionsMat[$i][$k] = 0; 
		} 
	} 

	// Initialize dijkstra calculator
	$dijkstra = new DijkstraCalculator($portConnectionsMat, I,$matrixWidth); 

	//Perform search
	$dijkstra->findShortestPath($fromClass, $toClass); 

	//Get results (some double checking for errors should be added here)
	$result = $dijkstra -> getHops((int)$toClass);

	if ($result == 0){
		//Do nothing actually
	}else{
		//Generate port names list using the result ids
		$pathResult = routeIDsToPortNames($result);
		
		print json_encode($pathResult);
	}

 

//return;

?>