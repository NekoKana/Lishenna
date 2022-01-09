<?php

namespace Lishenna\api;

class ApiPool
{
    private array $pool = [];
    private static $instance;

    private function __construct()
    {
        self::$instance = $this;
    }

    public static function getInstance(): ApiPool
    {
        if (self::$instance == null) {
            self::$instance = new ApiPool();
        }

        return self::$instance;
    }

    public function register(int $id, $api): bool
    {
        if (array_key_exists($id, $this->pool)) {
            return false;
        }

        $this->pool[$id] = $api;

        return true;
    }

    public function get(int $id)
    {
        if (array_key_exists($id, $this->pool)) {
            return $this->pool[$id];
        } else {
            return null;
        }
    }
}