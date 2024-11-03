<?php

namespace App\Models;

use PDO;

class Model
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getPDO(): PDO
    {
        return $this->db;
    }

    # set record into table
    public function set(string $table, array $record): bool
    {
        $keys = array_keys($record);
        $strKey = join(', ', $keys);
        $arrParams = array_map(fn($key) => (":$key"), $keys);
        $strParams = join(', ', $arrParams);

        $query = "insert into $table ($strKey) values ($strParams);";

        $stmt = $this->db->prepare($query);
        foreach ($keys as $key) {
            $stmt->bindValue(":$key", $record[$key]);
        }
        return $stmt->execute();
    }

    # get all records in a table
    public function getAll(string $tableName): array
    {
        $statement = $this->db->query("SELECT * FROM $tableName");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    # get record in a table by ID
    public function getByID(string $table, string $idName, int $id): array
    {
        $query = "select * from $table where $idName = :$idName;";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":$idName", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    # update record of table
    public function update(string $table, string $idName, int $id, array $newValue): bool
    {
        $keys = array_keys($newValue);
        $arrFields = array_map(fn($key) => ("$key = :$key"), $keys);
        $strFields = join(', ', $arrFields);
        $query = "update $table set $strFields where $idName = :$idName;";

        $stmt = $this->db->prepare($query);
        foreach ($keys as $key) {
            $stmt->bindValue(":$key", $newValue[$key]);
        }
        $stmt->bindValue(":$idName", $id);
        return $stmt->execute();
    }

    # delete record from table
    public function delete($table,$idName, $id)
    {
        $sql = "DELETE FROM $table WHERE $idName = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    # get records in table by attributes
    public function getByProps(string $table, array $props): array
    {
        $keys = array_keys($props);
        $params = array_map(fn($key) => ("$key = :$key"), $keys);
        $strParams = join(' and ', $params);
        $query = "select * from $table where $strParams";

        $stmt = $this->db->prepare($query);
        foreach ($keys as $key) {
            $stmt->bindValue(":$key", $props[$key]);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function usernameExists($username)
    {
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Trả về true nếu tồn tại
    }

    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Trả về true nếu tồn tại
    }

    protected function getItems($table, $limit, $offset, $searchTerm = '')
    {
        $sql = "SELECT * FROM $table WHERE fullname LIKE :searchTerm LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getTotalItems($table, $searchTerm = '')
    {
        $sql = "SELECT COUNT(*) FROM $table WHERE fullname LIKE :searchTerm";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function hasOrders($userId)
    {
        $sql = "SELECT COUNT(*) FROM orders WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn() > 0; // Trả về true nếu có đơn hàng
    }

    public function deleteOrdersByUserId($userId)
    {
        $sql = "DELETE FROM orders WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function countUsers()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();
    }
    
    public function countOrders()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM orders");
        return $stmt->fetchColumn();
    }

    public function countSuccessfulOrders()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM orders WHERE status = 'success'");
        return $stmt->fetchColumn();
    }

    public function calculateRevenue()
    {
        $stmt = $this->db->query("SELECT SUM(total_amount) FROM orders WHERE status = 'success'");
        return $stmt->fetchColumn() ?: 0; // Trả về 0 nếu không có doanh thu
    }
}