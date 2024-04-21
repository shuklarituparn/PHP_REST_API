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

}