<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'get': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, task_data.text, task_data.reward, tags, task_data.deadline, user.personal_data_login as login
 FROM task, task_data, user WHERE purchaser_user_email = user.email and task_id = :id and task.task_data_id = task_data.idtask_data", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['id' => $_GET['id']]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, task_data.text, task_data.reward, task_data.deadline, user.personal_data_login as login
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
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, task_data.text, task_data.reward, tags, task_id, task_data.deadline
 FROM task, task_data, user WHERE purchaser_user_email = user.email and task_data.idtask_data = task_data_id");
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

    case 'getOfficial': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, text, reward, tags, deadline
 FROM task, official_task, user WHERE purchaser_user_email = user.email and official_task_id = :id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        // надо будет подумать подольше над get или post здесь
        $query->execute(['id' => $_GET['id']]);
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

    case 'getAllOfficial': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, text, reward, tags, task_id, deadline
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
        if(isset($_SESSION['user']))
        {
            $query = $pdo->prepare('INSERT INTO task_data (text, deadline, reward, payment_method) VALUES (:text, :deadline, :reward, :payment_method)');
            $is_done = $query->execute(['text' => $_POST['text'], 'deadline' => $_POST['deadline'], 'reward' => $_POST['reward'], 'payment_method' => $_POST['payment_method']]);
            if ($is_done) {
                $query = $pdo->prepare('SELECT idtask_data FROM task_data ORDER BY idtask_data DESC LIMIT 1');
                $query->execute();
                $id = $query->fetch(PDO::FETCH_BOTH);

                if(isset($_POST['tags'])){
                    $query = $pdo->prepare('INSERT INTO task (purchaser_user_email, task_data_id, tags) VALUES(:email, :id, :tags)', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                    $query->execute(['email' => $_SESSION['email'], 'tags' => $_POST['tags'], 'id' => $id['idtask_data']]);
                }
                else{
                    $query = $pdo->prepare('INSERT INTO task (purchaser_user_email, task_data_id, tags) VALUES(:email, :id, NULL)', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                    $query->execute(['email' => $_SESSION['email'], 'id' => $id]);
                }
                $pdo = null;
                header('Location: ../burse');
                break;
            }

            echo 'error';
            header('Location: ../new_task');
            $pdo = null;
            break;
        }
    }

    case 'makeOfficial': {
        $query = $pdo->prepare("UPDATE task SET deadline=:deadline, reward=:reward
 WHERE task_id=:id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(["id" => $_POST['id']]);
        $query = $pdo->prepare("INSERT INTO official_task (official_task_id, chosen_freelancer, payment_method) VALUES (:id, :freelancer, :method)
 WHERE task_id=:id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(["id" => $_POST['id'], 'freelancer' => $_POST['freelancer'], 'method' => $_POST['payment_method']]);
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
}