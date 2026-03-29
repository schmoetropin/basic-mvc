<?php
    declare(strict_types=1);
    
    namespace App\Type;
    
    use \App\Prod\Product;
    
    class Book extends Product implements TypeInterface
    {
        // Create product description
        public function createProductType(array $data): ?array
        {
            $weight = $this->setIntNumber($data, 'weight');
            if (!is_null($weight)) {
                $book = [
                    'type'=> $this->getTypeId('book'),
                    'description' => [
                        'weight' => $weight,    
                    ],
                ];
                return $book;
            }
            return null;
        }

        // Display product description 
        public function displayDescription(object $data): string
        {
            return 'Weight: '.$data->weight.' KG';
        }
    };
?>