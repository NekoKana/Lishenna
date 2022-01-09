<?php

namespace Lishenna;

use Lishenna\api\ApiPool;

use Ratchet\ConnectionInterface;

class RequestHandler
{
    public function handle(ConnectionInterface $from, $data)
    {
        $id = $data["id"];
        $class = ApiPool::getInstance()->get($id);

        if ($class != null) {
            $api = $class::fromJson($from->resourceId, $data);
            $api->onSent($from);
        }
    }
}