<?php
    declare(strict_types=1);
    
    namespace App\Check;
    
    use \App\Con\Connection;
    
    class CheckOptionCreateObj extends Connection
    {
        use CheckDataTrait;
        
        // Check if option exists then creates an object from it
        public function type(array $post): ?object
        {
            if (isset($post['option'])) {
                $option = strtolower($post['option']);
                if ($this->checkOption($option)) {
                    $type = '\\App\\Type\\'.ucfirst($option);
                    if (class_exists($type)) {
                        $typeObj = new $type();
                        return $typeObj;
                    }
                    return null;
                }
                return null;
            }
            return null;
        }
    };
?>