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

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

 <script>
	$(document).ready(function(){
		
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
					portNames.push(allPortsList[i].PortName + ' (' + allPortsList[i].PortDescr + ')');
					portIDs.push(allPortsList[i].PortID);
					portCodes.push(allPortsList[i].PortCode);
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
				
			//	$( "#toDestination" ).autocomplete({
			//	  source: portNames
			//	});
			}
		});
		
		
     //   $("#fromDestination").keyup(function(){
     //       console.log($(this).val());
     //   });
	});
</script>

<!--
  <script>
 
  
  
  $(function() {
    var availableTags = [
      "Naxos",
      "Paros",
      "Pireus",
      "Santorini",
      "Amorgos",
      "Mykonos",
      "Serifos",
      "Sifnos",
      "Tinos",
      "Kythnos",
      "Koufonisia",
      "Herakleia",
      "Sikinos",
      "Folegandros",
      "Milos",
      "Schinousa",
      "Ios"
    ];
    $( "#fromDestination" ).autocomplete({
      source: availableTags
    });
    $( "#toDestination" ).autocomplete({
      source: availableTags
    });
  });
  
     function ShowActive(inputString){
     //gives visual that something is happening
     $('#Sresults').addClass('loading');
     //send your data to a php script here i am only sending one variable
     //if using more than one then use json format
     $.post("allactive.php", {queryString: ""+inputString+""}, function(data){
       if(data.length >0) {
         //populate div with results
         $('#Sresults').html(data);
         $('#Sresults').removeClass('loading');
       }
     });
   }
  </script>
-->
</head>

<body>
<div id="outPopUp">

<!--
<p><h1>SEAS.GR</h1></p>
<p><div><h3>Coming soon...</h3></div></p>
-->

<form class="form-wrapper cf">
        <input type="text" id="fromDestination" placeholder="Take me from..." required>
        <input type="text" id="toDestination" placeholder="to..." required>
        <button type="submit">Search</button>
    </form>  
</div>
<div id="copyrightContainer">
  <!-- Other elements here -->
  <div id="copyright">
    Copyright © 2016, Seas.gr
  </div>
</div>
</body>

</html>