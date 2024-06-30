<?php
/**
 * Knights Move.
 * Chess!
 * Statement: https://github.com/jmatah/KnightsTour.git
 * A knight's tour is a sequence of moves of a knight on a chessboard such that the knight visits every square exactly once.
 *
 * @package KnoghtsTour
 * @version 1.0.0
 * @author Jatin Matah @ https://jatin.dev
 * @license GPL
 * @demo http://www.m-solutions.co.in/chess/
 * 
 * @template Board.php.
 */
require_once 'header.php';
?>
<div id="proj_desc">
<div id="head"><a href="https://en.wikipedia.org/wiki/Knight%27s_tour" target="_blank">Wikipedia: Knight&#39;s Tour</a></div>
<div id="desc">A knight&#39;s tour is a sequence of moves of a knight on a chessboard such that the knight visits every square only once.</div>
</div>
<br class="clear"/>
<table border="1" style="border-collapse:collapse" id="container">
<tr valign="top">
<td>
	<table border="0" id="axisY"><tr><td>8</td></tr><tr><td>7</td></tr><tr><td>6</td></tr><tr><td>5</td></tr><tr><td>4</td></tr><tr><td>3</td></tr><tr><td>2</td></tr><tr><td>1</td></tr></table>
</td>
<td>
<table border="1" style="border-collapse:collapse" id="chessboard">
<?php

for ( $a = 8; $a > 0; $a-- ) {
	$col = ( $a % 2 == 0 ) ? 'colwhite' : 'colblack';
	echo '<tr id="row' . $a . '">';
	for ( $b = 1; $b <= 8; $b++ ) {
		echo '<td class="' . $col . '" id="col' . $b . '' . $a . '"></td>' . "\n";
		$col = ( 'colblack' === $col ) ? 'colwhite' : 'colblack';
	}
	echo '</tr>' . "\n";
}
?>
</table>
</td>
<td>
<strong class="tdheading">Knights Moves:</strong><img style="display:none" src="/chess/style/ajax.gif" border="0" id="doajax"/>
	<div id="plann"><div><ol><li>a1</li></ol></div><br/><span id="dores"></span></div>
</td>
<!-- <td>
<strong class="tdheading">Log:</strong>
	<div id="logg"><span id="dolog"></span></div>
</td> --> 
</tr>
<tr>
<td></td>
<td>
	<table border="0" id="axisX"><tr><td>a</td><td>b</td><td>c</td><td>d</td><td>e</td><td>f</td><td>g</td><td>h</td></tr></table>
</td>
<td olspan="2"><button id="start"> <<< Start >>> </button><!-- <button id="start2">Start</button> --></td>
</tr>
</table>
</div>
</div>
<script type="text/javascript">
if( typeof jQuery == "function" ){
jQuery(document).ready(function($){
	$("#col11").addClass("curpos");
});
}
</script>


<!-- Start of StatCounter Code -->
<script type="text/javascript" language="javascript">
var sc_project=1528541; 
var sc_invisible=1; 
var sc_partition=14; 
var sc_security="5e77d0ad"; 
</script>

<script type="text/javascript" language="javascript" src="http://www.statcounter.com/counter/counter.js"></script><noscript><a href="http://www.statcounter.com/" target="_blank"><img  src="http://c15.statcounter.com/counter.php?sc_project=1528541&amp;java=0&amp;security=5e77d0ad&amp;invisible=1" alt="stats count" border="0"></a> </noscript>
<!-- End of StatCounter Code -->

</body>
</html>
