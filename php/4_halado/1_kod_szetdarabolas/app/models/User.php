<?php

namespace App\Models;

use PDO;

class User
{
    public static PDO $db;
    private static string $table = 'people';

    public int $id;
    public string $first_name;
    public string $last_name;
    public string $gender = 'Female';
    public string $email;
    public string $city;
    public string $birthday;

    public static function all(): array
    {
        $table = self::$table;
        $stmt = self::$db->query("SELECT * FROM {$table}");
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function find(int $id): User|bool
    {
        $table = self::$table;
        $stmt = self::$db->prepare("SELECT * FROM {$table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::class);
    }

    public function save(): int
    {
        $table = self::$table;
        $stmt = self::$db->prepare("INSERT INTO {$table} (first_name, last_name, gender, email, city, birthday) VALUES (:first_name, :last_name, :gender, :email, :city, :birthday)");
        $stmt->execute([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'city' => $this->city,
            'birthday' => $this->birthday
        ]);
        return (int)self::$db->lastInsertId();
    }

}