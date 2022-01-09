<?php

namespace Lishenna;

use Lishenna\models\User;

class UserList
{
    private static $instance;

    protected array $users = [];

    private function __construct()
    {
        self::$instance = $this;
    }

    public static function getInstance(): UserList
    {
        if (self::$instance == null) {
            self::$instance = new UserList();
        }

        return self::$instance;
    }

    public function add(User $user)
    {
        $this->users[$user->getResourceId()] = $user;
    }

    public function remove(int $resourceId)
    {
        unset($this->users[$resourceId]);
    }

    public function get(int $resourceId): ?User
    {
        if ($this->has($resourceId)) {
            return $this->users[$resourceId];
        }
        
        return null;
    }

    public function has(int $resourceId)
    {
        return isset($this->users[$resourceId]);
    }

    public function all()
    {
        return $this->users;
    }

    public function clean()
    {
        $this->users = [];
    }
}