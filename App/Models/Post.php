<?php

namespace App\Models;
use Core\Model;
use PDO;
 class Post extends Model
 {
     public static function getAll()
     {
         try{
             $db=static::getPDO();
             $stmt = $db->query('SELECT id, title, content FROM posts ');
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

             return $results;

         }catch (PDOException $e){
             echo $e->getMessage();
         }

     }
 }