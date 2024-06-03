<?php 
ini_set('display_errors','on');
error_reporting(E_ALL);

class MyAutoLoad{
    public static function start(){
        spl_autoload_register(array(__CLASS__, 'autoload'));

        $host = $_SERVER['HTTP_HOST'];
        $root = $_SERVER['DOCUMENT_ROOT'];

        define('HOST', 'http://'.$host);
        define('ROOT', $root);
        define('CONTROLLER', ROOT.'/controllers/');
        define('DATABASE', ROOT.'/database/');
        define('VIEW', ROOT.'/views/');
        define('MODEL', ROOT.'/models/');
        define('ASSET', HOST.'/assets/');
        define('CSS', ASSET.'css/');
        define('PICTURE', ASSET.'pictures/');
        define('CARS', PICTURE.'cars/');
        define('CLASSE', ROOT.'/router/');
        define('VENDOR', ROOT.'/vendor/');
    }
    public static function autoload($class){
        if(file_exists(MODEL.$class.'.php')){
            include_once(MODEL.$class.'.php');
        } else if (file_exists(CLASSE.$class.'.php')){
            include_once(CLASSE.$class.'.php');
        } else if (file_exists(CONTROLLER.$class.'.php')){
            include_once(CONTROLLER.$class.'.php');
        } else if (file_exists(DATABASE.$class.'.php')){
            include_once(DATABASE.$class.'.php');
        };
        require (VENDOR.'autoload.php');
    }
}
?>