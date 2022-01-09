<?php

namespace Lishenna\database;

use ORM;
use PDO;
use Dotenv\Dotenv;

class UserDatabase
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        ORM::configure('mysql:host=localhost;dbname=hackathon');
        ORM::configure('username', 'root');
        ORM::configure('password', getenv('DB_PASSWORD'));
    }

    public function validate(int $userId, string $token): bool
    {
        $result = ORM::for_table("token")->where("user_id", $userId)->find_many();

        foreach ($result as $res) {
            if ($res->token == $token) {
                return true;
            }
        }

        return false;
    }
}