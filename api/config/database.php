<?php

$env_dir=__DIR__;
$env_file=$env_dir."/../../.env"; #to concat use "." damn
$env_data="";
if (file_exists($env_file)){
    $env_data=parse_ini_file($env_file);
}else{
    throw new Exception("Unable to load environment file: ".$env_file);
}
class Database {

    private $host;
    private $username;
    private $password;
    private $dbname;
    public $conn;

    public function __construct ()  //a constructor function
    {
        global $env_data;  //if declared outside the scope
        $this->dbname=$env_data["DB_NAME"];
        $this->password=$env_data["DB_PASSWORD"];
        $this->host=$env_data["DB_HOST"];
        $this->username=$env_data["DB_USERNAME"];

        //Now we have all this data
        //PDO- PHP Data Object

        $this->conn=null;

    }
    public function connect()
    {

        try{
            $conn= new PDO("mysql:host".$this->host.";dbname=".$this->dbname.$this->username.$this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn=$conn;
        }catch (PDOException $e){
            throw new Exception("Could not connect to DB");

            //can also do echo "mistake".$e->getMesage();
        }
        return $this->conn;
    }
}

