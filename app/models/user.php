<?php

namespace App\Models;

class User extends Model
{
    public function __construct($PDO)
    {
        parent::__construct($PDO);
    }

    public function getAllUsers()
    {
        return $this->getAll('users');
    }

    public function getUserById($id)
    {
        return $this->getByID('users', 'user_id', $id);
    }

    public function createUser($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->set('users', $data);
    }

    public function updateUser($id, $data)
    {
        return $this->update('users', 'user_id', $id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete('users', 'user_id', $id);
    }

    public function authenticate($username, $password)
    {
        $user = $this->getByProps('users', ['username' => $username]);
        if ($user && password_verify($password, $user[0]['password'])) {
            return $user[0];
        }
        return false;
    }
}