<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'getAll': {
        if (isset($_SESSION['user'])) {
            $res = [];
            $query = $pdo->prepare("SELECT name, surname, patronymic, verified, personal_data_login as login
    FROM user, message WHERE message.user_author = :user and personal_data_login = message.user_recepient", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['user' => $_SESSION['user']]);
            $res['dialogues'] = $query->fetchAll(PDO::FETCH_ASSOC);

            if(isset($_GET['id'])){
                $query = $pdo->prepare("SELECT text, user_author
        FROM message WHERE user_author = :user or user_recepient = :user", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $query->execute(['user' => $_GET['id']]);
                $res['messages'] = $query->fetchAll(PDO::FETCH_ASSOC);
            }

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
    }

    case "update": {
        $query = $pdo->prepare("UPDATE message SET text=:text
 WHERE message_id=:id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['id' => $_GET['id']]);
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
        // uses logins
        $query = $pdo->prepare("INSERT INTO message (user_author, user_recepient, text) VALUES (:author, :recepient, :text)", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['author' => $_SESSION['user'], 'recepient' => $_POST['recepient'], 'text' => $_POST['text']]);
        $query->fetch(PDO::FETCH_DEFAULT);

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