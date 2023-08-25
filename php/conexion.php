<?php
class Conexion
{
    private $host = 'localhost'; 
    private $user = 'root';      
    private $password = '1234567';  
    private $database = 'tienda';
    
    public $connection;

    public function __construct()
    {
        try{
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}",
                $this->user, $this->password );
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO:: ERRMODE_EXCEPTION);
 //           echo "ok";
        }catch (PDOException $e){
            echo "Error: ". $e->getMessage();
        }
    }


    public function getConnection()
    {
        return $this->connection;
    }

    public function response($ok, $data, $message, $code = 200)
    {
        return json_encode([
            "ok" => $ok,
            "message" => $message,
            "data" => $data
        ]);
    }
    
    
    public function getData()
    {
        try {
            $sql = "SELECT * FROM productos";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}






