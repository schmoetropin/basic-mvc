<?php
declare(strict_types=1);

namespace App\Check;

use \PDO;
use \Exception;

// A trait to check the data posted by user
trait CheckDataTrait
{
    // Check if the option selected in Type switch exists in database
    public function checkOption(string $input): bool
    {
        try {
            $query = "SELECT type FROM productType WHERE type=:type";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':type', $input);
            $prepare->execute();
            if ($prepare->rowCount() > 0) {
                return true;
            }
            return false; 
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Check if input is empty
    public function checkEmptyInput(string $input): bool
    {
        try {
            $impCheck = str_replace(' ', '', $input);
            if ($impCheck) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Check if input only have numbers
    public function checkNumber(string $input): bool
    {
        try {
            if (preg_match('/^[0-9]*$/', $input)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /*
    * Check if input have negative numbers
    * Useless right now because of preg_match but if in some update
    * allows other signs
    */
    public function checkNegativeNumber(string $input): bool
    {
        try {
            if ((int)$input < 0) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Check if sku is unique
    public function checkUniqueSKU(string $input): bool
    {
        try {
            $query = "SELECT sku FROM product WHERE sku=:sku";
            $prepare = $this->con()->prepare($query);
            $prepare->bindParam(':sku', $input);
            $prepare->execute();
            if ($prepare->rowCount() > 0) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Check string length
    public function checkLength(string $input): bool
    {
        try {
            if (strlen($input) > 3 && strlen($input) <= 20) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Remove quotation marks, remove tags an trim white spaces
    public function cleanStripTagsTrim(string $val): string
    {
        try {
            $arr = ['"', "'"];
            $val = str_replace($arr, '', $val);
            return strip_tags(trim($val));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
};