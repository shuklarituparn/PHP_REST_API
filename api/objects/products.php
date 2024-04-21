<?php

class Product{
    private $conn;
    private $table_name="products";  //These field to connect to the db

    //These field below will be the property of the objects

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db)
    {
        $this->conn=$db;  //connecting to the db
    }

    function read()
    {
        $query="SELECT 
        c.name as category_name, p.id, p.name, p.description,p.price,p.category_id, p.created
        
        FROM".$this->table_name."p
        
        LEFT JOIN
        
        Categories c 
        
        ON p.category_id=c.id
        
        ORDER BY
        
        p.created DESC;
        ";

        $stmt=$this->conn->prepare($query); //execute the query

        return $stmt;
    }

    function create()
    {
        $query= "I
        
         INSERT INTO".$this->table_name."
         
         SET name=:name, price=:price, decription=:description, category_id=:category_id, create=:created 
        
        ";

        $stmt=$this->conn->prepare($query);  //preparing the query to run

        $this->name=htmlspecialchars(strip_tags($this->name)); //cleanining our input
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->created = htmlspecialchars(strip_tags($this->created));


        //now we can bind the data in the query

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->created);

        if ($stmt->execute()){

            return true;
        }
        return false;
    }
    function readOne()
    {
        $query = "
        SELECT 
            c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM
            " . $this->table_name . " p
        LEFT JOIN 
            categories c 
        ON 
            p.category_id = c.id
        WHERE 
            p.id = ?
        LIMIT 1
    ";


        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$this->id); //substituting the user id in the query
        $stmt->execute();

        $row=$stmt->fetch(PDO::FETCH_ASSOC); //getting the row from the db
        $this->name=$row["name"];
        $this->price=$row["price"];
        $this->description = $row["description"];
        $this->category_id = $row["category_id"];
        $this->category_name = $row["category_name"];

    }


    public function update()
    {
        $query = "UPDATE
            " . $this->table_name . "
        SET
            name = :name,
            price = :price,
            description = :description,
            category_id = :category_id
        WHERE
            id = :id";

        $stmt=$this->conn->prepare($query);
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;

    }

    public function delete()
    {
        $query="DELETE FROM".$this->table_name."WHERE id=?";
        $stmt=$this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function search($keywords)
    {
        $query = "SELECT
            c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM
            " . $this->table_name . " p
            LEFT JOIN
                categories c
                    ON p.category_id = c.id
        WHERE
            p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
        ORDER BY
            p.created DESC";


        $stmt = $this->conn->prepare($query);


        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";


        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);


        $stmt->execute();

        return $stmt;

    }

    public function readPaging($from_record_num, $records_per_page)
    {
        $query = "SELECT
            c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM
            " . $this->table_name . " p
            LEFT JOIN
                categories c
                    ON p.category_id = c.id
        ORDER BY p.created DESC
        LIMIT ?, ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }

    public function count()
    {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row["total_rows"];
    }


}