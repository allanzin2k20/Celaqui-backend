<?php
class CellController{
    function create(){
        Router::allowedMethod('POST');
        
        $data = Input::getData();
        $marca = $data['marca'];
        $nome = $data['nome'];
        $preco = $data['preco'];
        $ano = $data['ano'];

        //TODO validar os campos

        $cell = new Cell(null, $marca, $nome, $preco, $ano);
        $id = $cell->create();

        $result["success"]["message"] = "cell created successfully!";
        $result["cell"] = $data;
        $result["cell"]["id"] = $id;
        Output::response($result);
    }

    function list(){
        Router::allowedMethod('GET');

        $cell = new Cell(null, null, null, null, null);
        $listCell = $cell->list();

        $result["success"]["message"] = "User list has been successfully listed!";
        $result["data"] = $listCell;
        Output::response($result);
    }

    function byId(){
        Router::allowedMethod('GET');

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        } else {
            $result['error']['message'] = "Id parameter required!";
            Output::response($result, 406);
        }
        
        $cell = new Cell($id, null, null, null, null);
        $userData = $cell->getById();

        if($userData){
            $result["success"]["message"] = "Cell successfully selected!";
            $result["data"] = $userData;
            Output::response($result);
        } else {
            $result["error"]["message"] = "User not found!";
            Output::response($result, 404);
        }
    }

    function delete(){
        Router::allowedMethod('DELETE');
        $data = Input::getData();

        if(isset($data['id'])){
            $id = $data['id'];
        } else {
            $result['error']['message'] = "Id parameter required!";
            Output::response($result, 406);
        }

        $cell = new Cell($id, null, null, null, null);
        $deleted = $cell->delete();

        if($deleted){
            $result["success"]["message"] = "Cell $id deleted successfully!";
            Output::response($result);
        } else {
            $result["error"]["message"] = "Cell $id not found to be deleted!";
            Output::response($result, 404);
        }
    }

    function update(){
        Router::allowedMethod('PUT');
        
        $data = Input::getData();
        $id = $data['id'];
        $marca = $data['marca'];
        $nome = $data['nome'];
        $preco = $data['preco'];
        $ano = $data['ano'];

        $cell = new Cell($id, $marca, $nome, $preco, $ano);
        $updated = $cell->update();

        if($updated){
            $result["success"]["message"] = "Cell updated successfully!";
            $result["user"] = $data;
            Output::response($result);
        } else {
            $result["error"]["message"] = "Cell $id not found to be updated!";
            Output::response($result, 404);
        }
    }
}
?> 