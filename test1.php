<html>
<head>
<title>Find shortest route!</title>

<script>

function clickMap(classID)
{
    if (document.form1.fromClass.value.length == 0)
    {
        document.form1.fromClass.value = classID;
    }
    else
    {
        document.form1.toClass.value = classID;
    }
}

</script>
</head>
<body>

<img src="teiMap.jpg"  usemap="#routes" border="0">

<MAP name="routes" >
    <AREA SHAPE="rect" COORDS="225,50, 300, 100"  href="java script:clickMap('1');" class="mymap" >
    <AREA SHAPE="rect" COORDS="400,400,500,500" href="java script:clickMap('3');"  class="mymap" >
</MAP>

<br><br>
<form name="form1" action="./calcPath.php" method="post">

From :
<input type="text" name="fromClass"/>

<br>
To :
<input type="text" name="toClass"/>
<br>
<input name=b1 type=submit value="Enter!">

</form>

<br></body></html>