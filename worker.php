<?php

/*

This is an example worker script. It listens on the ZMQ socket for a number
and multiplies it by 2 and returns the response.

It then sleeps for 3 seconds to simulate a more complex task.

*/

$context = new \ZMQContext();
$clientSocket = new \ZMQSocket($context, \ZMQ::SOCKET_REP);
$clientSocket->connect('ipc:///tmp/example.ipc');

do {

    $number = $clientSocket->recv();
    $clientSocket->send($number * 2);

    sleep(3);

} while (true);
