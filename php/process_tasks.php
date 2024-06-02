<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'get': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, text, reward, tags
 FROM task, user WHERE purchaser_user_email = user.email and task_id = :id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        // надо будет подумать подольше над get или post здесь
        $query->execute(['login' => $_GET['task_id']]);
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
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, text, reward, tags, task_id
 FROM task, user WHERE purchaser_user_email = user.email");
        $query->execute();
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

    case 'add': {
        $query = $pdo->prepare('INSERT INTO task (purchaser_user_email, text, preferred_deadline, reward, tags)
 VALUES (:text, :email, :deadline, :reward, :tags)', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['email' => $_GET['profile'], 'text' => $_POST['text'], 'deadline' => $_POST['deadline'], 'reward' => $_POST['reward'], 'tags' => $_POST['tags']]);

        header('Location: ../');
    }
}