<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class userModel extends Model
{
    // public function getUSers()
    // {

    //     $stmt = $this->DB->query("SELECT * FROM customers;");

    //     $result = $stmt->fetchAll();

    //     return $result;
    // }

    public static function createUser()
    {
        $DB = Database::getConnection();

        $data = Request::all();

        $hashPass = password_hash($data['password'], PASSWORD_DEFAULT);

        $DB->exec("INSERT INTO users 
        (role, name, email, password, phone, gender) 
        VALUES 
        ('{$data['role']}', '{$data['name']}', '{$data['email']}', '{$hashPass}', '{$data['phone']}', '{$data['gender']}' )");
    }

    public static function editUser(string $column, string $value)
    {
        $DB = Database::getConnection();

        $authId = auth('id');

        if($column === 'password') {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }

        $DB->exec("UPDATE users 
                    SET {$column} = '{$value}' 
                    WHERE id = '{$authId}'");
    }
}
