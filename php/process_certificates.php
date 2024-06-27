<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'get': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, text, reward, tags, preferred_deadline
 FROM task, user WHERE purchaser_user_email = user.email and task_id = :id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        // надо будет подумать подольше над get или post здесь
        $query->execute(['id' => $_GET['id'], 'login' => $_POST['login']]);
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
        if($_POST['tags'] || $_POST['tags'] == ''){
            $query = $pdo->prepare('INSERT INTO task (text, purchaser_user_email, preferred_deadline, reward)
 VALUES (:text, :email, :deadline, :reward)', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['text' => $_POST['text'], 'email' => $_SESSION['email'], 'deadline' => $_POST['deadline'], 'reward' => $_POST['reward']]);
        }
        else{
            $query = $pdo->prepare('INSERT INTO task (text, purchaser_user_email, preferred_deadline, reward, tags)
 VALUES (:text, :email, :deadline, :reward, :tags)', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['text' => $_POST['text'], 'email' => $_SESSION['email'], 'deadline' => $_POST['deadline'], 'reward' => $_POST['reward'], 'tags' => $_POST['tags'] ? $_POST['tags'] : '']);
        }

        header('Location: ../');
    }
}