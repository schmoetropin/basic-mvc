<?php
    declare(strict_types=1);

    namespace App\Check;

    use \App\Con\Connection;

    class CheckFormInput extends Connection
    {
        use CheckDataTrait;

        // Check if objectType was created or its null
        public function checkTypeObject($typeObj): ?object
        {
            if (!is_null($typeObj)) {
                return $typeObj;
            }
            echo $this->error(8);
            return null;
        }

        // Check the name
        public function checkName(array $input): ?string
        {
            if (isset($input['name'])) {
                $name = $this->cleanStripTagsTrim($input['name']);
                if (!$this->checkEmptyInput($name)) {
                    echo $this->error(0);
                    return null;
                } elseif (!$this->checkLength($name)) {
                    echo $this->error(1);    
                    return null;
                } else {
                    return (string)$name;
                }
            } 
            echo $this->error(10);
            return null;
        }

        // Check the SKU
        public function checkSku(array $input): ?string
        {
            if (isset($input['sku'])) {
                $sku = $this->cleanStripTagsTrim($input['sku']);
                if (!$this->checkEmptyInput($sku)) {
                    echo $this->error(2);
                    return null;
                } elseif (!$this->checkLength($sku)) {
                    echo $this->error(3);
                    return null;
                } elseif (!$this->checkUniqueSKU($sku)) {
                    echo $this->error(4);
                    return null;
                } else {
                    return (string)$sku;
                }
            }
            echo $this->error(9);
            return null;
        }

        // Check the price
        public function checkPrice(array $input): ?int
        {
            return $this->checkIntNumber($input, 'price');
        }

        // Check any integer input
        public function checkIntNumber(array $input, string $name): ?int
        {
            if (isset($input[$name])) {
                $number = $this->cleanStripTagsTrim($input[$name]);
                if (!$this->checkEmptyInput($number)) {
                    echo $this->error(5, $name);
                    return null;
                } elseif (!$this->checkNumber($number)) {
                    echo $this->error(6, $name);
                    return null;
                } else {
                    return (int)$number;
                }
            }
            echo $this->error(11, $name);
            return null;
        }

        // Displays all invalid posts or errors
        private function error(int $n, string $name = null): string
        {
            $upName = null;
            if (!is_null($name)) {
                $upName = ucfirst($name);
            }
            $err = [
/*00*/          '*Please, submit the name.',
/*01*/          '*Name should be between 4 and 20 characters.',
/*02*/          '*Please, submit the SKU.',
/*03*/          '*SKU should be between 4 and 20 characters.',
/*04*/          '*This SKU is already registered.',
/*05*/          '*Please, submit the '.$name.'.',
/*06*/          '*Please, provide the data of indicated type in '.$name.'.',
/*07*/          '*Only positive numbers are accepetd in '.$name.'.',
/*08*/          '*Select the product type on the Type switcher.',
/*09*/          '*SKU invalid input.',
/*10*/          '*Name invalid input.',
/*11*/          '*'.$upName.' invalid input.',
            ];
            return $err[$n];
        }
    }
?>