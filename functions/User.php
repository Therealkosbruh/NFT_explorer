<?php
require_once 'db.php';

class User {
    private $login;
    private $role;

    public function __construct($walletId) {
        $db = new Db();
        $userData = $db->getUserData($walletId);
        if ($userData) {
            $this->login = $userData['login'];
            $this->role = $userData['role'];
        }
    }

    public function getLogin() {
        return $this->login;
    }

    public function getRole() {
        return $this->role;
    }

    public function getRoleName() {
        $roles = [
            '1' => 'Пользователь',
            '2' => 'Администратор',
        ];
        return isset($roles[$this->role]) ? $roles[$this->role] : 'Неизвестная роль';
    }
}

