<?php

namespace src\models;

use PDO;

class Customer
{
    private PDO $db;

    public int $id = -1;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone;
    public string $address;
    public string $created_at;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function save(): bool
    {
        $result = false;

        if ($this->id >= 0) {
            $statement = $this->db->prepare(
                'UPDATE customers SET first_name = :first_name, last_name = :last_name, 
                email = :email, phone = :phone, address = :address, 
                created_at = now() WHERE id = :id'
            );
            $result = $statement->execute([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'id' => $this->id,
            ]);
        } else {
            $statement = $this->db->prepare(
                'INSERT INTO customers (first_name, last_name, email, phone, address, created_at) 
                VALUES (:first_name, :last_name, :email, :phone, :address, now())'
            );
            $result = $statement->execute([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
            ]);
            if ($result) {
                $this->id = $this->db->lastInsertId();
            }
        }

        return $result;
    }

    public function find(int $id): ?Customer
    {
        $statement = $this->db->prepare(
            'SELECT * FROM customers WHERE id = :id'
        );
        $statement->execute(['id' => $id]);

        if ($row = $statement->fetch()) {
            $this->fillFromDbRow($row);
            return $this;
        }

        return null;
    }

    public function delete(): bool
    {
        $statement = $this->db->prepare(
            'DELETE FROM customers WHERE id = :id'
        );
        return $statement->execute(['id' => $this->id]);
    }

    public function fill(array $data): Customer
    {
        $this->first_name = $data['first_name'] ?? '';
        $this->last_name = $data['last_name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->address = $data['address'] ?? '';
        return $this;
    }

    public function validate(array $data): array
    {
        $errors = [];

        $firstName = trim($data['first_name'] ?? '');
        if (!$firstName) {
            $errors['first_name'] = 'Invalid first name.';
        }

        $lastName = trim($data['last_name'] ?? '');
        if (!$lastName) {
            $errors['last_name'] = 'Invalid last name.';
        }

        $validEmail = filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL);
        if (!$validEmail) {
            $errors['email'] = 'Invalid email address.';
        }

        return $errors;
    }

    private function fillFromDbRow(array $row): Customer
    {
        [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'created_at' => $this->created_at
        ] = $row;
        return $this;
    }
}
