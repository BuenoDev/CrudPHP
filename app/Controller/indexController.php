<?php

require'./../Model/User.php';


switch($_SERVER['REQUEST_METHOD']){
    case'POST':
        switch($_POST['call']){
            case'save':
                $nome = $_POST['name'];
                $email = $_POST['email'];
                
                if($nome !='' && $email!='' && $nome !=null && $email!=null){
                    $user = new User($nome,$email);
                    $user->save();
                }
                break;
            
            case'update':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];

                $user = User::loadFromDb($id);
                if($name != null or $name != '') $user->name = $name;
                if($email != null or $email != '') $user->email = $email;
                $user->save();
                break;
        }

    case'GET':
        switch($_GET['call']){

            case'delete':
                $id = $_GET['id'];

                $user = User::loadFromDb($id);
                $user->delete();
                break;
            
            /**
             * Retorna uma lista de usuarios no formato JSON
             */
            case'renderTable':
                static $rowId = 0;
                $users = User::loadAll();

                echo json_encode($users);
                break;

        }
        
}

