<?php
    declare(strict_types=1);
    
    namespace App\Prod;
    
    use \App\Con\Connection;
    use \App\Type\TypeInterface;
    use \PDO;
    
    class CreateDeleteProduct extends Product
    {
        private Connection $con;
        private ?string $Sku;
        private ?string $Name;
        private ?int $Price;
        private ?int $Type;
        private ?string $Description;

        public function __construct()
        {
            parent::__construct();
            $this->con = new Connection();
        }
        
        // Create a new product
        public function createProduct(array $dataProd, TypeInterface $typeP = null): void
        {
            // Set sku, name and price
            $this->Sku = $this->setSku($dataProd);
            $this->Name = $this->setName($dataProd);
            $this->Price = $this->setPrice($dataProd);

            // Set product type and create his description
            $typeProduct = $this->setTypeObject($typeP);
            $data = null;
            if (!is_null($typeProduct)) {
                $data = $typeProduct->createProductType($dataProd);
            }
            
            if (
                !is_null($this->Sku) && !is_null($this->Name) && !is_null($this->Price) 
                && !is_null($typeProduct) && !is_null($data)
            ) {
                $this->Type = $data['type'];
                $this->Description = json_encode($data['description']);
                if (!is_null($product = $this->insertDataIntoProduct())) {
                    if ($this->insertDataIntoProductDescription($product)) {
                        echo 'Product created';
                    } else {
                        $this->deleteProduct([$sku]);
                    }
                }
            }
        }

        // Insert data into product table
        private function insertDataIntoProduct(): ?int
        {
            $query = "INSERT INTO product(sku, name, price, type)
                VALUES(:sku, :name, :price, :type)";
            $prepare = $this->con->con()->prepare($query);
            $prepare->bindParam(':sku', $this->Sku, PDO::PARAM_STR);
            $prepare->bindParam(':name', $this->Name, PDO::PARAM_STR);
            $prepare->bindParam(':price', $this->Price, PDO::PARAM_INT);
            $prepare->bindParam(':type', $this->Type, PDO::PARAM_INT);
            if ($prepare->execute()) { 
                return $this->getId($this->Sku);
            }
            return null;
        }

        // Insert data into productDescription table
        private function insertDataIntoProductDescription(int $product): bool
        {
            $query = "INSERT INTO productDescription(description, product) 
                VALUES(:description, :product)";
            $prepare = $this->con->con()->prepare($query);
            $prepare->bindParam(':description', $this->Description, PDO::PARAM_STR);
            $prepare->bindParam(':product', $product, PDO::PARAM_INT);
            if ($prepare->execute()) {
                return true;
            }
            return false;
        }

        // Delete selected products
        public function deleteProduct(array $skus): void
        {
            foreach ($skus as $sku) {
                $query = "DELETE from product WHERE sku=:sku";
                $prepare = $this->con->con()->prepare($query);
                $prepare->bindParam(':sku', $sku);
                $prepare->execute();
            }
        }
    };
?>