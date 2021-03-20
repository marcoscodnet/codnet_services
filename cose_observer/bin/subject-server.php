<?php
use Cose\Observer\model\impl\Subject;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

    require dirname(__DIR__) . '/vendor/autoload.php';

    $server = IoServer::factory(
         new WsServer(
            new Subject()
        )
     	//new Subject()
      , 8084
    );

    $server->run();