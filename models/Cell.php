<?php
class Cell {
    
    private $id;
    private $marca;
    private $nome;
    private $preco;
    private $ano;

    function __construct($id, $marca, $nome, $preco, $ano) {
        $this->id = $id;
        $this->marca = $marca;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->ano = $ano;
    }

    function create(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("INSERT INTO phones (marca, nome, preco, ano)
            VALUES (:marca, :nome, :preco, :ano)");
            $stmt->bindParam(':marca', $this->marca);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->bindParam(':ano', $this->ano);
            $stmt->execute();
            $id = $conn->lastInsertId();
            $conn = null;
            return $id;
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function list(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("SELECT * FROM phones");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $users;
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function getById(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("SELECT * FROM phones WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $cell = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            return $cell;
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function delete(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("DELETE FROM phones WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            $conn = null;
            if($rowsAffected){
                return true;
            } else {
                return false;
            }
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function update(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("UPDATE phones SET marca = :marca, nome = :nome, preco = :preco, ano = :ano WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':marca', $this->marca);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->bindParam(':ano', $this->ano);
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            if($rowsAffected){
                return true;
            } else {
                return false;
            }
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

}

?>