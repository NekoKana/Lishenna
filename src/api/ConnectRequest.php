<?php

namespace Lishenna\api;

use Lishenna\UserList;

use Lishenna\api\ApiIds;

use Lishenna\database\UserDatabase;

use Lishenna\models\User;

use Ratchet\ConnectionInterface;

class ConnectRequest implements Api
{
    private int $resourceId;
    private int $userId;
    private string $token;
    private int $roomId;

    public function __construct(int $resourceId, int $userId, string $token, int $roomId)
    {
        $this->resourceId = $resourceId;
        $this->userId = $userId;
        $this->token = $token;
        $this->roomId = $roomId;
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

    public static function getId(): int
    {
        return ApiIds::CONNECT_REQUEST;
    }

    public function onSent(ConnectionInterface $conn)
    {
        $db = new UserDatabase();
        if ($db->validate($this->getUserId(), $this->getToken())) {
            $user = new User($this->getResourceId(), $this->getRoomId(), $this->getUserId(), $this->getToken());
            UserList::getInstance()->add($user);
            # UserList::getInstance()->test();
        }
    }

    public static function fromJson(int $resourceId, array $json): ?Api
    {
        return new ConnectRequest($resourceId, $json["user_id"], $json["token"], $json["room_id"]);
    }
}