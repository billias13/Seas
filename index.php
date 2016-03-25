<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Seas</title>

<link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- Google Analytics Script -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75329523-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Latest compiled and minified CSS 

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
-->
<!-- jQuery library -->
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
-->
<!-- Latest compiled JavaScript

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



 <script>

  
	$(document).ready(function(){
		
		//$("#resultContainer").hide( );
		//Request the full list of ports from database
		$.get("getPorts.php", function(data, status){
			
			if (status == 'success'){
			
				allPortsList = JSON.parse(data);
			
				var numOfPorts = allPortsList.length;
				//console.log(allPortsList);
				//console.log(numOfPorts);
				var portNames = [];
				var portIDs = [];
				var portCodes = [];
				
				for (var i = 0; i < numOfPorts; i++) {
					//console.log(allPortsList[i].PortName + ' (' + allPortsList[i].PortDescr + ')');
					portNames.push(allPortsList[i].PortName);
					portIDs.push(allPortsList[i].PortID);
					//portCodes.push(allPortsList[i].PortCode);
				}
				
				$( "#fromDestination, #toDestination" ).autocomplete({
					autoFocus: true,
					source: portNames
				}).keyup(function() {
					var isValid = false;
					for (i in portNames) {
						if (portNames[i].toLowerCase().match(this.value.toLowerCase())) {
							
							isValid = true;
						}
					}
					if (!isValid) {
						this.value = previousValue
					} else {
						previousValue = this.value;
					}
				}).focusout(function() {
					var isValid = false;
					for (i in portNames) {
						if (portNames[i].toLowerCase() == this.value.toLowerCase()) {
							
							isValid = true;
						}
					}
					if (!isValid) {
						this.value = "";
					} else {
						
					}
				});
				
			}
			$( "#buttonBack" ).click(function() {
					$("#searchContainer").show("slow");
					$("#resultContainer").hide("slow");
			});
			
		   $("#searchForm").submit(function(event) {

					//stop form from submitting normally
					event.preventDefault();
					var $form = $(this);
					fromPort = $form.find('input[name="PortA"]').val(),
					toPort = $form.find('input[name="PortB"]').val()
					
					$.ajax({
						url: 'calcPath.php',
						type:'POST',
						data:
						{
							PortA: fromPort,
							PortB: toPort
						},
						success: function(msg)
						{
							if (msg != 0){
								
								var searchResult = jQuery.parseJSON( msg );
								
								console.log(searchResult)
								//console.log(searchResult[2].PortLng);
								
								//$("#searchContainer").hide("slow" );								
								//$("#resultContainer").show("slow"  );								
								
								
								map = new google.maps.Map(document.getElementById('map'), {
									zoom: 6,
									center: {lat: 36.841988, lng: 25.307007},		
									disableDefaultUI: true,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								});
								  

								var portConnectionCoordinates = { }; // main object
								// add 100 sub-object values
								var flightPlanCoordinates = [];
								for(i = 0; i < searchResult.length; ++i) {
									var point = {lat: parseFloat(searchResult[i].PortLat) , lng: parseFloat(searchResult[i].PortLng)};
									
									flightPlanCoordinates.push(point);
								}
								
					
								var flightPath = new google.maps.Polyline({
									path: flightPlanCoordinates,
									geodesic: true,
									strokeColor: '#34ABCD',
									strokeOpacity: 0.8,
									strokeWeight: 4
								});

								flightPath.setMap(map);
								
								var bounds = new google.maps.LatLngBounds();
								var markerImage = new google.maps.MarkerImage('favicon.ico',
								new google.maps.Size(30, 30),
								new google.maps.Point(0, 0),
								new google.maps.Point(15, 15));
								
								for (var port in flightPlanCoordinates) {
									// Add the circle for this city to the map.
									
									/*
									var sunCircle = {
										strokeColor: '#00C6FF',
										strokeOpacity: 1.0,
										strokeWeight: 3,
										fillColor: '#C3F2FF',
										fillOpacity: 1.0,
										map: map,
										center: flightPlanCoordinates[port],
										radius: 4000 
									};

									cityCircle = new google.maps.Circle(sunCircle)
									*/
									
									
									var marker = new google.maps.Marker({
									  position: flightPlanCoordinates[port],
									  map: map,
									  icon: markerImage
									});
									
									//extend the bounds to include each marker's position
									bounds.extend(marker.position);

								  }
								
								//now fit the map to the newly inclusive bounds
								map.fitBounds(bounds);
							}
						}               
					});
		   });

		});
		
		
	});
</script>


</head>

<body>

<div id="searchFormOuterContainer">

	<div id="searchContainer">
		<form id="searchForm" class="form-wrapper cf" action="./calcPath.php"  method="post">
			<input name="PortA" type="text" id="fromDestination" placeholder="Take me from..." required value="Naxos">
			<input name="PortB" type="text" id="toDestination" placeholder="to..." required value="Chania">
			<button name="submit" type="submit" value="Search">Search</button>
		</form>  
	</div>
	
</div>

<div id="mapOuterContainer">
		
		<div id="map" style="width:100%; height:100%;"></div>
		<!--<button id="buttonBack" name="back" value="Search">Back</button>-->

</div>


<div id="copyrightContainer">
  <!-- Other elements here -->
  <div id="copyright">
    Copyright © 2016, Seas.gr
  </div>
</div>
 <script>
      var map;
      function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 6,
			center: {lat: 36.841988, lng: 25.307007},			
			disableDefaultUI: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  });
		  
		  

      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdBxrS-Mh9wM_7Bvpufy0KCGZOEcbKMPY&callback=initMap&sensor=false" async defer>
</script>

</body>

</html>