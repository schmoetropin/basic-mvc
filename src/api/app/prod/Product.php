<?php
    declare(strict_types=1);
    
    namespace App\Prod;
    
    use \App\Con\Connection;
    use \App\Check\CheckFormInput;
    use \App\Check\CheckOptionCreateObj;
    use \PDO;
    
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
            $query = "SELECT id FROM product WHERE sku=:sku";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':sku',$sku);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['id'];
        }

        protected function getSku(int $id): ?string
        {
            $query = "SELECT sku FROM product WHERE id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['sku'];
        }

        protected function getName(int $id): ?string
        {
            $query = "SELECT name FROM product WHERE id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['name'];
        }

        protected function getPrice(int $id): ?int
        {
            $query = "SELECT price FROM product WHERE id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['price'];
        }

        protected function getProductDescription(int $id): ?string
        {
            $query = "SELECT description FROM productDescription WHERE product=:product";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':product',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['description'];
        }

        protected function getType(int $id): ?string
        {
            $query = "SELECT t.type FROM product p JOIN productType t ON 
                p.type=t.id WHERE p.id=:id";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':id',$id);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['type'];
        }

        protected function getTypeId(string $type): int
        {
            $query = "SELECT id FROM productType WHERE type=:type";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':type',$type);
            $prepare->execute();
            $fetch = $prepare->fetch(PDO::FETCH_ASSOC);
            return $fetch['id'];
        }

/******************************
 *          SETTERS
 *****************************/
        protected function setTypeObject($typeObj): ?object
        {
            $typeObj = $this->checkForm->checkTypeObject($typeObj);
            if (!is_null($typeObj)) {
                return $typeObj;
            }
            return null;
        }

        protected function setName(array $input): ?string
        {
            $name = $this->checkForm->checkName($input);
            if (!is_null($name)) {
                return $name;
            }
            return null;
        }

        protected function setSku(array $input): ?string
        {   
            $sku = $this->checkForm->checkSku($input);
            if (!is_null($sku)) {
                return $sku;
            }
            return null;
        }

        protected function setPrice(array $input): ?int
        {
            $price = $this->checkForm->checkPrice($input);
            if (!is_null($price)) {
                return $price;
            }
            return null;
        }

        public function setIntNumber(array $input, string $name): ?int
        {
            $number = $this->checkForm->checkIntNumber($input, $name);
            if (!is_null($number)) {
                return $number;
            }
            return null;
        }
    };
?>