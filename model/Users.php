<?php

namespace app\model;

class Users extends ModelDb
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;

    protected $prop = [
        'pass' => false,
        'hash' => false
    ];

    public static function getSql()
    {
    }

    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function getTableName()
    {
        return 'users';
    }

    public function is_admin()
    {
        if ($this->login === "admin") return true;
    }
}
