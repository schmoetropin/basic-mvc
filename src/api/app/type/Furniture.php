<?php
    declare(strict_types=1);
    
    namespace App\Type;
    
    use \App\Prod\Product;
    
    class Furniture extends Product implements TypeInterface
    { 
        // Create product description
        public function createProductType(array $data): ?array
        {
            $height = $this->setIntNumber($data, 'height');
            $width = $this->setIntNumber($data, 'width');
            $length = $this->setIntNumber($data, 'length');
            if (!is_null($height) && !is_null($width) && !is_null($length)) {
                $furniture = [
                    'type'=> $this->getTypeId('furniture'),
                    'description' => [
                        'height' => $height,
                        'width' => $width,
                        'length' => $length,
                    ],
                ];
                return $furniture;
            }
            return null;
        }

        // Display product description 
        public function displayDescription(object $data): string
        {
            return 'Dimension: '.$data->height.'x'.$data->width.'x'.$data->length;
        }
    };
?>