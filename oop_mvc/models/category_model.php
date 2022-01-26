<?php
class Category extends Database{
  
    // connexion à la base de données et nom de la table
    
    private $table_name = "categories";
  
   // propriétés de l'objet
    private $id;
    private $name;
  
    public function __construct()

{
 parent::__construct();
}
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
  
    // utilisé par la liste déroulante de sélection
    function read(){
        //sélectionner toutes les données
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
  
// utilisé pour lire le nom de la catégorie par son ID
function readName(){
      
    $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
    $this->name = $row['name'];
}

function readCategory()
{

    $query = "SELECT
                id, name
            FROM
                " . $this->table_name . "";
           

    $stmt = $this->conn->prepare($query);
    if($stmt->execute()){
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    return $result;
}



}


?>