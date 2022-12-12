<?php
class Database{

    static function connect(){        
        try { 
        
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            return $conn;
        
        } catch(PDOException $e) {
            
        }
    }

    static function dbError($e){
        $result["error"]["message"] = "Server error, please try again!";
        $result["error"]["database"] = $e;
        Output::response($result, 500);
    }
}
?>