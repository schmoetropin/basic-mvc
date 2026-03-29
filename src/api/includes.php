<?php
declare(strict_types=1);

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: *'); 
/*
header('Access-Control-Allow-Origin: http://marcospaulopeters-scandiwebjrtest.epizy.com'); 
header('Access-Control-Allow-Headers: http://marcospaulopeters-scandiwebjrtest.epizy.com'); 
*/
define('ROOT', __DIR__.DIRECTORY_SEPARATOR);
define('APP_PATH', ROOT.'app'.DIRECTORY_SEPARATOR);
define('CON_PATH', APP_PATH.'con'.DIRECTORY_SEPARATOR);
define('CHECK_PATH', APP_PATH.'check'.DIRECTORY_SEPARATOR);
define('PROD_PATH', APP_PATH.'prod'.DIRECTORY_SEPARATOR);
define('TYPE_PATH', APP_PATH.'type'.DIRECTORY_SEPARATOR);

require_once(CON_PATH.'Connection.php');
require_once(CHECK_PATH.'CheckDataTrait.php');
require_once(CHECK_PATH.'CheckFormInput.php');
require_once(CHECK_PATH.'CheckOptionCreateObj.php');
require_once(PROD_PATH.'Product.php');
require_once(PROD_PATH.'CreateDeleteProduct.php');
require_once(PROD_PATH.'DisplayProduct.php');
require_once(TYPE_PATH.'TypeInterface.php');
require_once(TYPE_PATH.'Dvd.php');
require_once(TYPE_PATH.'Book.php');
require_once(TYPE_PATH.'Furniture.php');