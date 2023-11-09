<?php
	/*
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);
	*/
	$lijst = array(	'wortel.rekenen.php', 
					'wortel.rekenen.5.php',
					'wortel.rekenen.2.php',
					'wortel.rekenen.3.php',
					'wortel.rekenen.4.php');
	$reeks = $lijst[rand(0, count($lijst)-1)];
	require_once($reeks);
?>
