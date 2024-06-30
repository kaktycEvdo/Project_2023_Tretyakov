<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'get': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, task_data.text, task_data.reward, tags, task_data.deadline, task_data.payment_method, user.personal_data_login as login
 FROM task, task_data, user WHERE purchaser_user_email = user.email and task_id = :id and task.task_data_id = task_data.idtask_data", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['id' => $_GET['id']]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        $query = $pdo->prepare("SELECT count(task_id) as task_number
 FROM task, user WHERE purchaser_user_email = user.email and user.personal_data_login = :login", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['login' => $res['login']]);
        $res['task_number'] = $query->fetch(PDO::FETCH_DEFAULT);

        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, task_data.text, task_data.reward, task_data.deadline, task_data.payment_method, user.personal_data_login as login, feedback_id as id
 FROM feedback, task_data, user WHERE freelancer_user_email = user.email and task_task_id = :id and feedback.task_data_id = task_data.idtask_data");
        $query->execute(['id' => $_GET['id']]);
        $res['feedbacks'] = $query->fetchAll(PDO::FETCH_ASSOC);

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
        if (isset($_SESSION['user'])) {
            $query = $pdo->prepare("SELECT number, expiry, sc
    FROM card WHERE user_email = :email", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['email' => $_SESSION['email']]);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($res || sizeof($res) == 0){
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($res);
                $pdo = null;
                break;
            }
        }
        echo "error";
        $pdo = null;
        break;
    }

    case 'add': {
        if (isset($_SESSION['user'])) {
            $query = $pdo->prepare("INSERT INTO card (number, expiry, sc, user_email) VALUES (:number, :expiry, :sc, :email)", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['number' => $_POST['number'], 'expiry' => $_POST['expiry'], 'sc' => $_POST['scc'], 'email' => $_SESSION['email']]);
            header('Location: ../cards');
        }
        echo "error";
        header('Location: /');
        $pdo = null;
        break;
    }
    case 'delete': {
        if (isset($_SESSION['user'])) {
            $query = $pdo->prepare("DELETE FROM card WHERE number = :number and user_email = :email", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['number' => $_GET['id'], 'email' => $_SESSION['email']]);
            header('Location: ../cards');
        }
        echo "error";
        header('Location: /');
        $pdo = null;
        break;
    }
}