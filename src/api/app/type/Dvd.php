<?php
declare(strict_types=1);

namespace App\Type;

use \App\Prod\Product;

class Dvd extends Product implements TypeInterface
{
    // Create product description
    public function createProductType(array $data): ?array
    {
        try {
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
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Display product description 
    public function displayDescription(object $data): string
    {
        try {
            return 'Size: '.$data->size.' MB';
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
};