<?php

namespace app\controllers;

use app\interfaces\ILogin;
use app\model\Users;

class AuthController  implements ILogin
{
    public $auth;
    public $user;

    public function __construct()
    {
        $this->auth = $this->auth();
    }

    public function auth()
    {
        if (isset($_SESSION['id'])) {
            $this->user = Users::getOneArray($_SESSION['id']);
            if (!empty($this->user)) {
                return  true;
            }
        }
        if ($_COOKIE['hash']) {
            $this->user = Users::getOneHash($_COOKIE['hash']);
            if ($this->user) {
                $_SESSION['id'] = $this->user->id;
                return  true;
            }
        }
    }
    
    public function actionLogin()
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $user = Users::getOneLogin($login);
        if ($user) {
            if (password_verify($pass, $user->pass)) {
                $_SESSION["login"] = $login;
                $_SESSION['id'] = $user->id;
                if ($_POST['save']) {
                    $hash = uniqid(rand(), true);
                    $user->hash = $hash;
                    $user->update();
                    setcookie('hash', $hash, time() + 3600, '/');
                }
            } else {
                die('не верный пароль');
            }    
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function actionLogout()
    {
        session_destroy();
        setcookie('hash', '', time() - 3600, '/');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        session_reset();
    }
}
