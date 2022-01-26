<?php
class Database{
   
    // spécifiez vos propres informations d'identification de la base de données
    private $host = "localhost";
    private $db_name = "php_oop_crud_level_1";
    private $username = "root";
    private $password = "";
    public $conn;
   

    public function __construct()
    {
        $this->conn = null;
   
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
   
        return $this->conn;
    }
}
?>