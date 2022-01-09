<?php

use Lishenna\Server;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;

require_once __DIR__ . "/vendor/autoload.php";

define("DEBUG", true);

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Server()
            )
        ),
    19999
);

$server->run();