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
        $query = $pdo->prepare("SELECT task_data.text, task_data.reward, tags, task_id, task_data.deadline, user.surname
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

    case 'getAllOfficial': {
        $query = $pdo->prepare("SELECT task_data.text, task_data.reward, task.tags, task.task_id, task_data.deadline
 FROM official_task, task, task_data, user
 WHERE (task_purchaser_user_email = :email1 or chosen_freelancer = :email2) and official_task.task_task_id = task.task_id
 and task_data.idtask_data = task_data_id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['email1' => $_SESSION['email'], 'email2' => $_SESSION['email']]);
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
                    $query->execute(['email' => $_SESSION['email'], 'id' => $id['idtask_data']]);
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

    case 'edit': {
        if(isset($_SESSION['user']))
        {
            $query = $pdo->prepare('SELECT task_id, task_data_id FROM task WHERE task_id = :id LIMIT 1', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['id' => $_GET['task_id']]);
            $ids = $query->fetch(PDO::FETCH_ASSOC);

            $query = $pdo->prepare('UPDATE task_data SET text = :text, deadline = :deadline, reward = :reward, payment_method = :pm WHERE idtask_data = :tid', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $is_done = $query->execute(['text' => $_POST['text'], 'deadline' => $_POST['deadline'], 'reward' => $_POST['reward'], 'pm' => $_POST['payment_method'], 'tid' => $ids['task_data_id']]);
            if ($is_done) {
                if(isset($_POST['tags'])){
                    $query = $pdo->prepare('UPDATE task SET tags = :tags WHERE task_id = :id', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                    $is_done = $query->execute(['tags' => $_POST['tags'], 'id' => $ids['task_id']]);
                }

                $pdo = null;
                header('Location: ../task?task_id='.$_GET['task_id']);
                break;
            }

            echo 'error';
            header('Location: ../new_task?task_id='.$_GET['task_id'].'&action=edit');
            $pdo = null;
            break;
        }
    }

    case 'makeOfficial': {
        $query = $pdo->prepare('SELECT task_data_id FROM task WHERE task_id=:id', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(["id" => $_POST['id']]);

        $query = $pdo->prepare("UPDATE task_data SET deadline=:deadline, reward=:reward, payment_method=:pm
 WHERE task_data_id=:id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(["id" => $_POST['id']]);

        $query = $pdo->prepare("INSERT INTO official_task (official_task_id, chosen_freelancer) VALUES (:td, :freelancer)
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