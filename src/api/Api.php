<?php

namespace Lishenna\api;

use Lishenna\api\Api;

use Ratchet\ConnectionInterface;

interface Api
{
    public static function getId(): int;

    public static function fromJson(int $resourceId, array $json): ?Api;

    public function onSent(ConnectionInterface $conn);
}