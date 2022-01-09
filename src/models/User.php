<?php

namespace Lishenna\models;

use Lishenna\models\Room;

class User
{
    private int $resourceId;
    private int $roomId;
    private int $userId;
    private string $token;

    public function __construct(int $resourceId, int $roomId, int $userId, string $token)
    {
        $this->resourceId = $resourceId;
        $this->roomId = $roomId;
        $this->userId = $userId;
        $this->token = $token;
    }

    public function getResourceId(): int
    {
        return $this->resourceId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getToken(): string
    {
        return $this->getToken();
    }
}