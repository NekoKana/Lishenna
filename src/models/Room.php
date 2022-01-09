<?php

namespace Lishenna\models;

class Room
{
    private int $roomId;
    private string $roomName;
    private int $prefId;
    private int $cityId;

    public function __construct(int $roomId, string $roomName, int $prefId, int $cityId)
    {
        $this->roomId = $roomId;
        $this->roomName = $roomName;
        $this->prefId = $prefId;
        $this->cityId = $cityId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getRoomName(): string
    {
        return $this->roomName;
    }

    public function getPrefectureId(): int
    {
        return $this->prefId;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }
}