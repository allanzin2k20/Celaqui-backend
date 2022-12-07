<?php
class Cel {
    
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
            $stmt = $conn->prepare("INSERT INTO users (marca, nome, preco, ano)
            VALUES (:name, :email, :pass, :avatar)");
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
            $stmt = $conn->prepare("SELECT id, marca, nome, preco, ano FROM lista de celulares");
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
            $stmt = $conn->prepare("SELECT id, marca, nome, preco, ano FROM lista de celulares WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            return $user;
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function delete(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id;");
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
            $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, avatar = :avatar WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':avatar', $this->avatar);
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
    
    function login(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("SELECT id, role FROM users WHERE pass = :pass AND email = :email;");
            $stmt->bindParam(':pass', $this->pass);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            if(is_array($user)){
                return $user;
            } else {
                return false;
            }
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

}

?>