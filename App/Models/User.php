<?php
namespace App\Models;

use Core\Model;
use PDO;
 class User extends Model {
     public static function getUserByEmail($email)
     {
         try{
             $conn=static::getPDO();
             $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
             $stmt->bindParam(':email',$email,PDO::PARAM_STR);
             $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
             return $result;

         }catch (PDOException $e){
             echo $e->getMessage();
         }
     }
     public static function getUserByPhone($phone)
     {
         try{
             $conn=static::getPDO();
             $stmt = $conn->prepare('SELECT * FROM users WHERE phone = :phone');
             $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
             $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
             return $result;

         }catch (PDOException $e){
             echo $e->getMessage();
         }
     }
     public static function getUserById($id)
     {
         try{
             $conn=static::getPDO();
             $stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');
             $stmt->bindParam(':id',$id,PDO::PARAM_STR);
             $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
             return $result;

         }catch (PDOException $e){
             echo $e->getMessage();
         }
     }
     public static function registerUser($data)
     {
         try{
             $conn=static::getPDO();
             $stmt = $conn->prepare("INSERT INTO users (email, phone, password) VALUES (:email ,:phone ,:password)");
             $stmt->bindParam(':email',$data['email'],PDO::PARAM_STR);
             $stmt->bindParam(':phone',$data['phone'],PDO::PARAM_STR);
             $stmt->bindParam(':password',$data['password'],PDO::PARAM_STR);
             $stmt->execute();
             return true;

         }catch (PDOException $e){
             echo $e->getMessage();
         }
     }
     public static function loginUser($email,$password)
     {
         try{
             $conn = static::getPDO();
             $stmt = $conn->prepare("SELECT * FROM users WHERE email =:email");
             $stmt->bindParam(':email',$email , PDO::PARAM_STR);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             $hashed_password = $row['password'];
             if (password_verify($password,$hashed_password)){
                 return $row;
             } else {
                 return false;
             }

         }catch (PDOException $e){
             echo $e->getMessage();
         }
     }
 }