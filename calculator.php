<?php

	require_once __DIR__ . '/vendor/autoload.php';
	
	// Check for correct usage with a single argument 
	if ($argc != 2) {
		echo sprintf( "Invalid argument. Use as follows:\nphp %s \"calculation\"\n", $argv[0] );
		die();
	}
	
	// Assumption: only valid calculation string will be passed
	// No need to syntax check
	$calculation = $argv[1];

	echo "The answer is: " . CalculationParser::calculate( $calculation ) . "\n";
	
	
?>