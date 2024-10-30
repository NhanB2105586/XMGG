<?php

namespace App\Models;

class User extends Model
{
    public function create($full_name, $username, $password, $email, $phone, $address)
    {
        return $this->set('users', [
            'full_name' => $full_name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ]);
    }

    public function findById($user_id)
    {
        return $this->getByID('users', 'user_id', $user_id);
    }

    public function updateUser($user_id, $data)
    {
        return $this->update('users', 'user_id', $user_id, $data);
    }

    public function deleteUser($user_id)
    {
        return $this->delete('users', 'user_id', $user_id);
    }

    public function getAllUsers()
    {
        return $this->getAll('users');
    }
}