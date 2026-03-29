<?php
declare(strict_types=1);

namespace App\Prod;

use \App\Con\Connection;
use \App\Check\CheckFormInput;
use \App\Check\CheckOptionCreateObj;
use \PDO;
use \Exception;

abstract class Product extends Connection
{
    private CheckFormInput $checkForm;
    public CheckOptionCreateObj $createObj;

    public function __construct()
    {
        $this->checkForm = new CheckFormInput();
        $this->createObj = new CheckOptionCreateObj();
    }

    /******************************
     *          GETTERS
     *****************************/
    protected function getId(string $sku): ?int
    {
        try {
            $query = "SELECT id FROM product WHERE sku=:sku";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':sku',$sku);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['id'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function getSku(int $id): ?string
    {
        try {
            $query = "SELECT sku FROM product WHERE id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['sku'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function getName(int $id): ?string
    {
        try {
            $query = "SELECT name FROM product WHERE id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['name'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function getPrice(int $id): ?int
    {
        try {
            $query = "SELECT price FROM product WHERE id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['price'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function getProductDescription(int $id): ?string
    {
        try {
            $query = "SELECT description FROM productDescription WHERE product=:product";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':product',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['description'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function getType(int $id): ?string
    {
        try {
            $query = "SELECT t.type FROM product p JOIN productType t ON 
                p.type=t.id WHERE p.id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['type'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function getTypeId(string $type): int
    {
        try {
            $query = "SELECT id FROM productType WHERE type=:type";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':type',$type);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['id'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /******************************
     *          SETTERS
     *****************************/
    protected function setTypeObject($typeObj): ?object
    {
        try {
            $typeObj = $this->checkForm->checkTypeObject($typeObj);
            if (!is_null($typeObj)) {
                return $typeObj;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function setName(array $input): ?string
    {
        try {
            $name = $this->checkForm->checkName($input);
            if (!is_null($name)) {
                return $name;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function setSku(array $input): ?string
    {
        try {
            $sku = $this->checkForm->checkSku($input);
            if (!is_null($sku)) {
                return $sku;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function setPrice(array $input): ?int
    {
        try {
            $price = $this->checkForm->checkPrice($input);
            if (!is_null($price)) {
                return $price;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function setIntNumber(array $input, string $name): ?int
    {
        try {
            $number = $this->checkForm->checkIntNumber($input, $name);
            if (!is_null($number)) {
                return $number;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
};