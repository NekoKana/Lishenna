<?php

namespace Lishenna;

use Lishenna\RequestHandler;

use Lishenna\utils\Logger;

use Lishenna\api\ApiPool;
use Lishenna\api\ApiIds;
use Lishenna\api\ConnectRequest;
use Lishenna\api\SendChatFromClient;

use Lishenna\database\UserDatabase;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use Ratchet\App;

class Server implements MessageComponentInterface
{
    protected $clients;
    protected $handler;

    private $socket;
    private $remote;

    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Server();
        }

        return self::$instance;
    }

    public function __construct()
    {
        Logger::info("サーバを起動しています...");

        $this->clients = new \SplObjectStorage;
        $this->handler = new RequestHandler();

        ApiPool::getInstance()->register(ConnectRequest::getId(), ConnectRequest::class);
        ApiPool::getInstance()->register(SendChatFromClient::getId(), SendChatFromClient::class);

        self::$instance = $this;

        Logger::success("サーバが正常に起動しました！");
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        Logger::info("{$conn->resourceId} がサーバに接続しました。");
    }

    public function onMessage(ConnectionInterface $from, $context)
    {
        $numRecv = count($this->clients) - 1;
        // Logger::info("{$from->resourceId} : {$context}");
        $rawJson = base64_decode($context);

        if ($rawJson !== false) {
            $data = json_decode($rawJson, true);
            if ($data !== null) {
                $this->handler->handle($from, $data);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        Logger::info("{$conn->resourceId} がサーバから切断しました。");

        UserList::getInstance()->remove($conn->resourceId);
    }

    public function onError(ConnectionInterface $conn, \Throwable $e)
    {
        Logger::error("不明なエラーが発生しました : {$e->getMessage()}");

        $conn->close();
    }

    public function getClients()
    {
        return $this->clients;
    }
}