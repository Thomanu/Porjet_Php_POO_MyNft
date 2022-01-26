<?php
class Product extends Database
{

    // connexion à la base de données et nom de la table

    private $table_name = 'products';

    // propriétés de l'objet
    private $id = 0;
    private $name = '';
    private $price = 0;
    private $description = '';
    private $category_id = 0;
    private $image = '';

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
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice()
    {
        return $this->id;
    }
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription()
    {
        return $this->id;
    }
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function setCategoryId($cat_id)
    {
        $this->category_id = $cat_id;
        return $this;
    }

    public function getImage()
    {
        return $this->category_id;
    }
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    // créer un produit
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . '(
            `name`,
            `description`,
            `price`,
            `category_id`,
            `image`
        )
        VALUES(
            :name,
            :description,
            :price,
            :category_id,
            :image
        )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function readAll($from_record_num = 0, $records_per_page = 10)
    {

        $query = "SELECT
                    id, name, description, price, category_id, image
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        // var_dump($result);
        return $result;
    }

    // utilisé pour la pagination des produits
    public function countAll()
    {

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    public function readOneProduct()
    {
        $query = "SELECT
            id, name, description, price, category_id, image
        FROM
            " . $this->table_name . "
        WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function update() 
    {
        $query = "UPDATE
                " . $this->table_name . "
            SET
                `name` = :name,
                `price` = :price,
                `description` = :description,
                `category_id`  = :category_id,
                `image`= :image
                
            WHERE
                `id` = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $this->price, PDO::PARAM_INT);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
        $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        
        $stmt->execute();
    }

    // supprimer le produit
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // lire les produits par terme de recherche
    public function search($search_term, $from_record_num, $records_per_page)
    {

        // sélectionner la requête
        $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.image, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ? OR p.description LIKE ?
            ORDER BY
                p.name ASC
            LIMIT
                ?, ?";

        // préparation de la requête
        $stmt = $this->conn->prepare($query);

        // lier les valeurs des variables
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

        // exécuter la requête
        $stmt->execute();

        // retour des valeurs de la base de données
        return $stmt;
    }

    public function countAll_BySearch($search_term)
    {

        // sélection de la requête
        $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " p
            WHERE
                p.name LIKE ? OR p.description LIKE ?";

        // préparation de la requête
        $stmt = $this->conn->prepare($query);

        // lier les valeurs des variables
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
}
