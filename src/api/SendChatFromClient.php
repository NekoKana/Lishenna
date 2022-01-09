<?php

namespace Lishenna\api;

use Lishenna\UserList;

use Lishenna\api\ApiIds;

use Lishenna\database\UserDatabase;

use Lishenna\models\User;

use Ratchet\ConnectionInterface;

class SendChatFromClient implements Api
{
    private int $resourceId;
    private int $userId;
    private string $token;
    private int $roomId;
    private string $text;
    private int $timeStamp;

    public function __construct(int $resourceId, int $userId, string $token, int $roomId, string $text, int $timeStamp)
    {
        $this->resourceId = $resourceId;
        $this->userId = $userId;
        $this->token = $token;
        $this->roomId = $roomId;
        $this->text = $text;
        $this->timeStamp = $timeStamp;
    }

    public function getResourceId(): int
    {
        return $this->resourceId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTimeStamp(): int
    {
        return $this->timeStamp;
    }

    public static function getId(): int
    {
        return ApiIds::SEND_CHAT_FROM_CLIENT;
    }

    public function onSent(ConnectionInterface $conn)
    {
        if (UserList::getInstance()->has($this->getResourceId())) {
            foreach (UserList::getInstance()->all() as $user) {
                if ($user->getRoomId() == $this->getRoomId() && $user->getUserId() != $this->getUserId()) {
                    foreach (Server::getInstance()->getClients() as $client) {
                        if ($user->getResourceId() == $client->resourceId) {
                            $client->send($this->getText());
                        }
                    }
                }
            }
        }
    }

    public static function fromJson(int $resourceId, array $json): ?Api
    {
        return new SendChatFromClient($resourceId, $json["user_id"], $json["token"],
        $json["room_id"], $json["text"], $json["timestamp"]);
    }
}