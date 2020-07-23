<?php

namespace App\Models;

use Core\Model;
use PDO;

class Car extends Model
{
    public static function getCar($data)
    {
        $i = 0;
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $i++;
            }
        }
        if ($i == 3) {
            $q = 'SELECT * FROM cars ORDER BY posted_at DESC';
        } elseif ($i == 2) {
            if (!empty($data['brand'])) $q = 'SELECT * FROM cars WHERE brand = :brand ORDER BY posted_at DESC ';
            if (!empty($data['price'])) $q = 'SELECT * FROM cars WHERE price <= :price ORDER BY posted_at DESC';
            if (!empty($data['year'])) $q = 'SELECT * FROM cars WHERE date_of_product >= :date_of_product ORDER BY posted_at DESC';
        } elseif ($i == 1) {
            if (empty($data['brand'])) $q = 'SELECT * FROM cars WHERE price <= :price AND date_of_product >= :date_of_product ORDER BY posted_at DESC';
            if (empty($data['price'])) $q = 'SELECT * FROM cars WHERE brand = :brand AND date_of_product >= :date_of_product ORDER BY posted_at DESC';
            if (empty($data['year'])) $q = 'SELECT * FROM cars WHERE brand = :brand AND price <= :price ORDER BY posted_at DESC';
        } elseif ($i == 0) {
            $q = 'SELECT * FROM cars WHERE brand = :brand AND price <= :price AND date_of_product >= :date_of_product ORDER BY posted_at DESC';
        }
        try {
            $conn = static::getPDO();
            $stmt = $conn->prepare($q);
            if (!empty($data['brand'])) $stmt->bindParam(':brand', $data['brand'], PDO::PARAM_STR);
            if (!empty($data['year'])) $stmt->bindParam(':date_of_product', $data['year'], PDO::PARAM_INT);
            if (!empty($data['price'])) $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;


        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getCarById($id)
    {

        try {
            $conn = static::getPDO();
            $stmt = $conn->prepare('SELECT * ,
                                             Cond.id AS CarId,
                                             users.id AS UserID,
                                             Cond.posted_at AS CarPosted,
                                             users.created_at AS UserCreated
                                                FROM 
                                                  (
                                                      SELECT *
                                                      FROM cars
                                                      WHERE id = :id
                                                  ) Cond
                                                  INNER JOIN users
                                                  ON Cond.user_id = users.id
                                              ');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;


        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public static function getCarByUserId($id)
    {

        try {
            $conn = static::getPDO();
            $stmt = $conn->prepare('SELECT * FROM cars WHERE user_id = :user_id ORDER BY posted_at DESC ');
            $stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;


        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public static function deleteCarById($id)
    {

        try {
            $conn = static::getPDO();
            $stmt = $conn->prepare('DELETE FROM cars WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            return true;


        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function sellCar($data)
    {
        try {
            $conn = static::getPDO();

            $a = "INSERT INTO cars (brand, user_id, " . (empty($data['model']) ? "" : " model,") . (empty($data['picture']) ? "" : " picture,") . " date_of_product, price," . (empty($data['power']) ? "" : " power,") . (empty($data['co_value']) ? "" : " trash,") . " transmition, is_second, owners," . (empty($data['distance']) ? "" : " distance,") . (empty($data['fuel_consumes']) ? "" : " consumes,") . " fuel) VALUES 
            (:brand ,:user_id ," . (empty($data['model']) ? "" : ":model ,") . (empty($data['picture']) ? "" : ":picture ,") . ":date_of_product ,:price ," . (empty($data['power']) ? "" : ":power ,") . (empty($data['co_value']) ? "" : ":trash ,") . ":transmition ,:is_second ,:owners ," . (empty($data['distance']) ? "" : ":distance ,") . (empty($data['fuel_consumes']) ? "" : ":consumes ,") . ":fuel)";
            $stmt = $conn->prepare($a);
            $stmt->bindParam(':brand', $data['brand'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_STR);
            if (!empty($data['model'])) $stmt->bindParam(':model', $data['model'], PDO::PARAM_STR);
            if (!empty($data['picture'])) $stmt->bindParam(':picture', $data['picture'], PDO::PARAM_STR);
            $stmt->bindParam(':date_of_product', $data['year'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            if (!empty($data['power'])) $stmt->bindParam(':power', $data['power'], PDO::PARAM_STR);
            if (!empty($data['co_value'])) $stmt->bindParam(':trash', $data['co_value'], PDO::PARAM_STR);
            $stmt->bindParam(':transmition', $data['transmition'], PDO::PARAM_STR);
            $stmt->bindParam(':is_second', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':owners', $data['owner'], PDO::PARAM_STR);
            if (!empty($data['distance'])) $stmt->bindParam(':distance', $data['distance'], PDO::PARAM_STR);
            if (!empty($data['fuel_consumes'])) $stmt->bindParam(':consumes', $data['fuel_consumes'], PDO::PARAM_STR);
            $stmt->bindParam(':fuel', $data['fuel'], PDO::PARAM_STR);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function updateCar($data)
    {
        try {
            $conn = static::getPDO();

            $a = "UPDATE cars 
                  SET brand = :brand, user_id = :user_id, " . (empty($data['model']) ? "" : " model = :model,") . (empty($data['picture']) ? "" : " picture = :picture,") . " date_of_product = :date_of_product, price = :price," . (empty($data['power']) ? "" : " power = :power,") . (empty($data['co_value']) ? "" : " trash = :trash,") . " transmition = :transmition, is_second = :is_second, owners = :owners," . (empty($data['distance']) ? "" : " distance = :distance,") . (empty($data['fuel_consumes']) ? "" : " consumes = :consumes,") . " fuel = :fuel
                  WHERE id = :id
                 ";
            $stmt = $conn->prepare($a);
            $stmt->bindParam(':id', $data['CarId'], PDO::PARAM_STR);
            $stmt->bindParam(':brand', $data['brand'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_STR);
            if (!empty($data['model'])) $stmt->bindParam(':model', $data['model'], PDO::PARAM_STR);
            if (!empty($data['picture'])) $stmt->bindParam(':picture', $data['picture'], PDO::PARAM_STR);
            $stmt->bindParam(':date_of_product', $data['year'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            if (!empty($data['power'])) $stmt->bindParam(':power', $data['power'], PDO::PARAM_STR);
            if (!empty($data['co_value'])) $stmt->bindParam(':trash', $data['co_value'], PDO::PARAM_STR);
            $stmt->bindParam(':transmition', $data['transmition'], PDO::PARAM_STR);
            $stmt->bindParam(':is_second', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':owners', $data['owner'], PDO::PARAM_STR);
            if (!empty($data['distance'])) $stmt->bindParam(':distance', $data['distance'], PDO::PARAM_STR);
            if (!empty($data['fuel_consumes'])) $stmt->bindParam(':consumes', $data['fuel_consumes'], PDO::PARAM_STR);
            $stmt->bindParam(':fuel', $data['fuel'], PDO::PARAM_STR);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}