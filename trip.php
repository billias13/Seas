<?php

include 'Dijkstra.php';

	if($_POST['submit'] == "Search")
	{
		//echo $_POST['PortA'] . '<br />';
		//echo $_POST['PortB'] . '<br />';
	}
	
	/*
	$graph = array(
	  'A' => array(3, 2, 1, 23, 25, 24, 21),
	  'B' => array(3, 15, 4, 7, 14, 13, 16, 18, 8, 17),
	  'C' => array(3, 11, 12, 1, 17)
	);
	*/
	$graph = array(
		'1' => array('2' => 1),
		'2' => array('1' => 1, '3' => 1),
		'3' => array('2' => 1, '4' => 1),
		'4' => array('3' => 1, '7' => 1),
		'5' => array('6' => 1),
		'6' => array('2' => 1),
		'7' => array('4' => 1,'8' => 1),
		'8' => array('7' => 1,'9' => 1),
		'9' => array('8' => 1)
	);
	
	$graphSimple = array(
		'1' => array('2','15'),
		'2' => array('1', '3'),
		'3' => array('2', '4'),
		'4' => array('3', '7', '13'),
		'5' => array('6'),
		'6' => array('2'),
		'7' => array('4','8'),
		'8' => array('7','9'),
		'9' => array('8','10'),	
		'10' => array('9','11'),
		'11' => array('10','12'),
		'12' => array('11','14'),	
		'13' => array('4','14'),	
		'14' => array('13','12','15'),	
		'15' => array('14','1'),	
	);
	
class Graph
{
  protected $graph;
  protected $visited = array();

  public function __construct($graph) {
    $this->graph = $graph;
  }

  // find least number of hops (edges) between 2 nodes
  // (vertices)
  public function breadthFirstSearch($origin, $destination) {
    // mark all nodes as unvisited
    foreach ($this->graph as $vertex => $adj) {
      $this->visited[$vertex] = false;
    }

    // create an empty queue
    $q = new SplQueue();

    // enqueue the origin vertex and mark as visited
    $q->enqueue($origin);
    $this->visited[$origin] = true;

    // this is used to track the path back from each node
    $path = array();
    $path[$origin] = new SplDoublyLinkedList();
    $path[$origin]->setIteratorMode(
      SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP
    );

    $path[$origin]->push($origin);

    $found = false;
    // while queue is not empty and destination not found
    while (!$q->isEmpty() && $q->bottom() != $destination) {
      $t = $q->dequeue();

      if (!empty($this->graph[$t])) {
        // for each adjacent neighbor
        foreach ($this->graph[$t] as $vertex) {
          if (!$this->visited[$vertex]) {
            // if not yet visited, enqueue vertex and mark
            // as visited
            $q->enqueue($vertex);
            $this->visited[$vertex] = true;
            // add vertex to current path
            $path[$vertex] = clone $path[$t];
            $path[$vertex]->push($vertex);
          }
        }
      }
    }

    if (isset($path[$destination])) {
      echo "From $origin to $destination in ", 
        count($path[$destination]) - 1,
        " hops <br>";
      $sep = '';
      foreach ($path[$destination] as $vertex) {
        echo $sep, $vertex;
        $sep = ' to ';
      }
      echo "<br>";
    }
    else {
      echo "No route from $origin to $destination <br>";
    }
  }
}

class Dijkstra2
{
  protected $graph;

  public function __construct($graph) {
    $this->graph = $graph;
  }

  public function shortestPath($source, $target) {
	
    // array of best estimates of shortest path to each
    // vertex
    $d = array();
    // array of predecessors for each vertex
    $pi = array();
    // queue of all unoptimized vertices
    $Q = new SplPriorityQueue();

    foreach ($this->graph as $v => $adj) {

      $d[$v] = INF; // set initial distance to "infinity"
      $pi[$v] = null; // no known predecessors yet
	  
	 
      foreach ($adj as $w => $cost) {
        // use the edge cost as the priority
        $Q->insert($w, $cost);
		//echo ' -> '.$w ;
      }
		//echo '<br>';
    }

    // initial distance at source is 0
    $d[$source] = 0;

    while (!$Q->isEmpty()) {
		
      // extract min cost
      $u = $Q->extract();
	 
      if (!empty($this->graph[$u])) {
        // "relax" each adjacent vertex
        foreach ($this->graph[$u] as $v => $cost) {
          // alternate route length to adjacent neighbor
          $alt = $d[$u] + $cost;
          // if alternate route is shorter
          if ($alt < $d[$v]) {
            $d[$v] = $alt; // update minimum length to vertex
            $pi[$v] = $u;  // add neighbor to predecessors
                           //  for vertex
          }
        }
      }
    }

    // we can now find the shortest path using reverse
    // iteration
    $S = new SplStack(); // shortest path with a stack
    $u = $target;
    $dist = 0;
    // traverse from target to source
    while (isset($pi[$u]) && $pi[$u]) {
      $S->push($u);
      $dist += $this->graph[$u][$pi[$u]]; // add distance to predecessor
      $u = $pi[$u];
    }

    // stack will be empty if there is no route back
    if ($S->isEmpty()) {
      echo "No route from $source to $target";
    }
    else {
      // add the source node and print the path in reverse
      // (LIFO) order
      $S->push($source);
      $sep = '';
      foreach ($S as $v) {
        echo $sep, $v;
        $sep = ' -> ';
      }
      echo " Distance : $dist ";
      echo "<b>";
    }
  }
}

$g = new Dijkstra($graph);

$g->shortestPath('1', '7'); 

$gs = new Graph($graphSimple);
$gs->breadthFirstSearch(4, 15);

	
?>
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
		

	});
</script>


</head>

<body>

	<div id="outPopUp">

	

</div>
<div id="copyrightContainer">
  <!-- Other elements here -->
  <div id="copyright">
		Copyright © 2016, Seas.gr
  </div>
</div>
</body>

</html>