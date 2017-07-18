<?php
include 'alisms.lib.class.php'; 

class Sms {
    public static $instance = null;
    public static function setAccessKey($accessKey, $accessSec) {
        self::$instance = new Alisms($accessKey, $accessSec);
        return self::$instance;
    }
}  
?>