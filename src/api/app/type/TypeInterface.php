<?php
declare(strict_types=1);

namespace App\Type;

// Interface for the product type, methods to create and display description
interface TypeInterface
{
    public function createProductType(array $data): ?array;
    public function displayDescription(object $data): string;
};