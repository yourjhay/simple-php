<?php

namespace App\Models;
use PDO;
use Simple\Model;

class User extends Model{

    public static function getAll() {
       try {
           $db = static::DB();
           $stmt = $db->query('SELECT * from users');
           $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $results;
       } catch(PDOException $e) {
           echo $e->getMessage();
       }
    }
}