<?php

	require_once __DIR__ . '/vendor/autoload.php';

	$context = new \ZMQContext();
	$clientSocket = new \ZMQSocket($context, \ZMQ::SOCKET_REP);
	$clientSocket->connect('ipc:///tmp/calc.ipc');

	do {

		$equation = $clientSocket->recv();
		$answer = CalculationParser::calculate( $equation );
		$clientSocket->send($answer);

		sleep( rand(0, 5) );

	} while (true);
