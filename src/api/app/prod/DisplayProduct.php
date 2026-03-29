<?php
    declare(strict_types=1);
    
    namespace App\Prod;

    use \App\Con\Connection;
    use \PDO;
    
    class DisplayProduct extends Product
    {
        private Connection $con;

        public function __construct()
        {
            parent::__construct();
            $this->con = new Connection();
        }

        // Get all ids from products
        private function getAllProductsIds(): array
        {
            $query = "SELECT id FROM product ORDER BY id DESC";
            $prepare = $this->con->con()->prepare($query);
            $prepare->execute();
            $arr = [];
            if ($prepare->rowCount() > 0) {
                while ($row = $prepare->fetch(PDO::FETCH_ASSOC)) {
                    $arr[] = $row['id'];
                }
            }
            return $arr;
        }

        // Display all products
        public function display(): ?array
        {
            $ids = $this->getAllProductsIds();
            $idsCount = count($ids);
            $arr = [];
            for ($i = 0; $i < $idsCount; $i++) {
                $option = ['option' => $this->getType($ids[$i])];
                $obj = $this->createObj->type($option);
                $desc = json_decode($this->getProductDescription($ids[$i]));
                $description = $obj->displayDescription($desc);
                $arr[$i] = [
                    'sku' => $this->getSku($ids[$i]),
                    'name' => $this->getName($ids[$i]),
                    'price' => $this->getPrice($ids[$i]),
                    'description' => $description,
                ];
            }
            return $arr;
        }
    };
?>