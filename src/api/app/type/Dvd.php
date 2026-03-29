<?php
    declare(strict_types=1);
    
    namespace App\Type;
    
    use \App\Prod\Product;
    
    class Dvd extends Product implements TypeInterface
    {
        // Create product description
        public function createProductType(array $data): ?array
        {
            $size = $this->setIntNumber($data, 'size');
            if (!is_null($size)) {
                $dvd = [
                    'type'=> $this->getTypeId('dvd'),
                    'description' => [
                        'size' => $size,
                    ],
                ];
                return $dvd;
            }
            return null;
        }

        // Display product description 
        public function displayDescription(object $data): string
        {
            return 'Size: '.$data->size.' MB';
        }
    };
?>