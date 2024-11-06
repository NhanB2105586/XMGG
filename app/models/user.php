<?php

namespace App\Models;
use PDO;
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

    public function addUser(array $data): bool
    {
        return $this->set('users', $data);
    }

    public function updateUser(int $id, array $data): bool
    {
        return $this->update('users', 'user_id', $id, $data);
    }

    public function deleteUser(int $id): bool
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

    public function getCustomersSearch($limit, $offset, $searchTerm = '')
    {
        return $this->getItems('users', $limit, $offset, $searchTerm);
    }

    public function getTotalCustomersSearch($searchTerm = '')
    {
        return $this->getTotalItems('users', $searchTerm);
    }

    
}