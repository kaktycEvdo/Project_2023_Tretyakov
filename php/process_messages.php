<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'getAll': {
        $query = $pdo->prepare("SELECT name, surname, patronymic, verified
 FROM user, message WHERE message.user_author = :user and personal_data_login = message.user_author", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['user' => $_SESSION['user']]);
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($res || sizeof($res) == 0){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($res);
            $pdo = null;
            break;
        }

        echo "error";
        $pdo = null;
        break;
    }

    case "update": {
        $query = $pdo->prepare("UPDATE message SET text=:text
 WHERE message_id=:id");
        $query->execute();
        $res = $query->fetch(PDO::FETCH_DEFAULT);

        if ($res){
            echo "success";
            $pdo = null;
            break;
        }

        echo "error";
        $pdo = null;
        break;
    }

    case 'add': {
        $query = $pdo->prepare("INSERT INTO message (user_author, user_recepient, text) VALUES (:author, :recepient, :text)", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['author' => $_POST['author'], 'recepient' => $_POST['recepient'], 'text' => $_POST['text']]);
        $res = $query->fetch(PDO::FETCH_DEFAULT);

        if ($res){
            $pdo = null;
            break;
        }

        $pdo = null;
        break;
    }
    
    case 'delete':{
        $query = $pdo->prepare("UPDATE last_login = NOW() IN user WHERE personal_data_login=:login", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['login' => $_SESSION['user']]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        if ($res){
            $_SESSION['user'] = null;
            $_SESSION['email'] = null;
            $pdo = null;
            break;
        }

        $pdo = null;
        break;
    }
}