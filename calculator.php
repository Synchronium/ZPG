<?php

	require_once __DIR__ . '/vendor/autoload.php';
	
	// Check for correct usage with a single argument 
	if ($argc != 2) {
		echo sprintf( "Invalid argument. Use as follows:\nphp %s \"calculation\"\n", $argv[0] );
		die();
	}
	
	// Assumption: only valid equation string will be passed
	// No need to syntax check
	$equation = $argv[1];

	$context = new \ZMQContext();
	$serverSocket = new \ZMQSocket($context, \ZMQ::SOCKET_REQ);
	$serverSocket->bind('ipc:///tmp/calc.ipc');

    $serverSocket->send($equation);
    $result = $serverSocket->recv();
    echo sprintf( 'The answer is %d', $result ) . PHP_EOL;
	
?>