<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'get': {
        $query = $pdo->prepare("SELECT name, surname, patronymic, verified,
 freelancer.about as freelancer_about, purchaser.about as purchaser_about, freelancer.characteristics as freelancer_chars, purchaser.characteristics as purchaser_chars
 FROM user, freelancer, purchaser WHERE personal_data_login=:login", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        // надо будет подумать подольше над get или post здесь
        @$_GET['login']
        ? $query->execute(['login' => $_GET['login']])
        : $query->execute(['login' => $_SESSION['user']]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        if ($res){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($res);
            $pdo = null;
            break;
        }

        echo "error";
        $pdo = null;
        break;
    }

    case 'getAll': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, text
 FROM task, user WHERE purchaser_user_email = user.email", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        var_dump($res);

        if ($res){
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