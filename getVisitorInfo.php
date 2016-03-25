<?php

$db = new mysqli('localhost', 'seasDatabaseAdmin', 'ratm!#', 'seasBasicDatabase');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}


//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}

$ip = "192.168.2.1";
//The value of $ip at this point would look something like: "192.0.34.166"
//$ip = ip2long($ip);
//echo $ip."<br>";
//The $ip would now look something like: 1073732954

$sql= "SELECT * FROM SeasVisitors WHERE VisitorIP='".$ip."'";
$query = mysqli_query($db, $sql);


if ($result=mysqli_query($db,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  //printf("Result set has %d rows.\n",$rowcount);
  
  // Free result set
  mysqli_free_result($result);
  
  if ($rowcount == 0){
	  
	  $sql = "INSERT INTO SeasVisitors (VisitorIP) VALUES ('".$ip."')";
	  
		//echo $sql."<br>";

		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $db->error;
		}

		$db->close();
	
		  
	}
  
  
}
  
 
  

?>