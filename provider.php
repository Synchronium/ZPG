<?php

/*

This is an example provider which generates random numbers and sends them down
the ZMQ socket for a worker to multiply.

There is no sleep in this script, it will run as fast as the workers allow.

*/

$context = new \ZMQContext();
$serverSocket = new \ZMQSocket($context, \ZMQ::SOCKET_REQ);
$serverSocket->bind('ipc:///tmp/example.ipc');

do {

    $number = rand(0, 1000);
    echo sprintf(
        'I wonder how much %d times two is...',
        $number
    ).PHP_EOL;

    $serverSocket->send($number);
    $msg = $serverSocket->recv();
    echo sprintf(
        '%d times two is %d',
        $number, $msg
    ).PHP_EOL;

} while (true);
