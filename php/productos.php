<?php

require_once ('./conexion.php');

class Producto
{

    private $db;
    private $con;

    function __construct()
    {
        $this->db = new Conexion();
        $this->con = $this->db->getConnection();

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                if (isset($_GET['id'])) {
                    echo $this->getProductoCode($_GET['id']);
                    return;
                }
                echo $this->getProductos(); 
                break;            

            case "POST":
                echo $this->createProducto($_POST);
                break;

            case "PUT":
                echo $this->updateProducto();
                break;

            case "DELETE":
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    echo $this->deleteProducto($id);
                } else {
                    echo $this->db->response(false, null, "Debe proporcionar un ID de producto para eliminar", 400);
                }
                break;
                
            default:
                echo $this->db->response(false, null, "Metodo no soportado", 400);
                break;

        }

    }

    function getProductos() // todos los productos
    {
        try {
           $query ="SELECT * FROM Productos";
           $stmt = $this->con->prepare($query);
           $stmt->execute();

           $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

           return $this->db->response(true, $result, "Listado de productos");

        } catch (PDOException $e) {
            return $this->db->response(false, null, $e->getMessage(), 500);
        }
    }

    function getProductoCode(string $code) // un solo producto
    { 
        try{
            $query = "SELECT * FROM Productos Where id = :code";

            //preparar la consulta
            $stmt = $this->con->prepare($query);

            //asignar los parametros
            $stmt->bindParam("code", $code);

            //la ejecución de la consulta
            $stmt->execute();

            //hacer un fetch de los datos
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //prerar la respuesta para el cliente
            return $this->db->response(true, $result, "Listado de prodcutos");
        } catch (PDOException $e) {
            return $this->db->response(false, null, $e->getMessage(), 500);
        }

    }

    function createProducto($infoProducto) //POST
    {
        $query = "INSERT INTO Productos (id, nombre, descripcion, precio) 
        VALUES (:id, :nombre, :descripcion, :precio);";
    
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":id", $infoProducto["id"]);
        $stmt->bindParam(":nombre", $infoProducto["nombre"]);
        $stmt->bindParam(":descripcion", $infoProducto["descripcion"]);
        $stmt->bindParam(":precio", $infoProducto["precio"]);
    
        if ($stmt->execute()) {
            echo $this->db->response(true, null, "Producto agregado", 201);
        } else {
            echo $this->db->response(false, null, "Error al agregar el producto", 500);
        }
    }
    

    function updateProducto() // PUT
    {
        // Verifica si se proporcionó un ID en la solicitud
        if (!isset($_GET['id'])) {
            echo $this->db->response(false, null, "Se requiere un ID para actualizar el producto", 400);
            return;
        }
    
        $productId = $_GET['id'];
    
        $inputData = file_get_contents("php://input");
        $requestData = json_decode($inputData, true); 
    
        if (!$requestData) {
            echo $this->db->response(false, null, "Error al leer los datos de la solicitud", 400);
            return;
        }
    
        // Implementa la lógica para actualizar el producto con el ID dado
        try {
            $query = "UPDATE Productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id = :id";
            $stmt = $this->con->prepare($query);
    
            // Enlaza los parámetros
            $stmt->bindParam(":id", $productId);
            $stmt->bindParam(":nombre", $requestData["nombre"]);
            $stmt->bindParam(":descripcion", $requestData["descripcion"]);
            $stmt->bindParam(":precio", $requestData["precio"]);
    
            if ($stmt->execute()) {
                echo $this->db->response(true, null, "Producto actualizado exitosamente", 200);
            } else {
                echo $this->db->response(false, null, "Error al actualizar el producto", 500);
            }
        } catch (PDOException $e) {
            echo $this->db->response(false, null, $e->getMessage(), 500);
        }
    }
    
    

    function deleteProducto($id) // DELETE
    {
        try {
            $query = "DELETE FROM Productos WHERE id = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":id", $id);
    
            if ($stmt->execute()) {
                return $this->db->response(true, null, "Producto eliminado exitosamente");
            } else {
                return $this->db->response(false, null, "Error al eliminar el producto", 500);
            }
        } catch (PDOException $e) {
            return $this->db->response(false, null, $e->getMessage(), 500);
        }
    }
    
}


$producto = new Producto();

