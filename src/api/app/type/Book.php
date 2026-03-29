<?php
declare(strict_types=1);

namespace App\Type;

use \App\Prod\Product;
use \Exception;

class Book extends Product implements TypeInterface
{
    // Create product description
    public function createProductType(array $data): ?array
    {
        try {
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
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Display product description 
    public function displayDescription(object $data): string
    {
        try {
            return 'Weight: '.$data->weight.' KG';
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
};