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
 * @template header.php.
 */
?><!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>CHESS - Knight's tour</title>
<meta name="robots" content="all" />
<meta name="robots" content="index,follow" />
<meta name="robots" content="archive" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="./style/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	var ajax_nonce = '<?php echo round( date( 'Y' ) * date( 'm' ) / date( 'd' ) ); ?>';
	var ajaxurl    = './index.php';
</script>
<script type="text/javascript" src="./js/chess.js"></script>
</head>
<body id="cbody">
<div id="page">
<div id="header">
	<div id="logo">Chess
	<div id="tagline">Knight's tour</div>
	</div>
</div>
<div id="content">
