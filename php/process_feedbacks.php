<?php
session_start();
require_once 'connect_to_db.php';

switch ($_GET['action']){
    case 'get': {
        $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, task_data.text, task_data.reward, task_data.deadline, user.personal_data_login as login
 FROM feedback, task_data, user WHERE freelancer_user_email = user.email and feedback_id = :id and feedback.task_data_id = task_data.idtask_data");
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
    
//     case 'getAll': {
//         $query = $pdo->prepare("SELECT user.name, user.surname, user.patronymic, user.verified, text, reward, tags, task_id
//  FROM task, user WHERE purchaser_user_email = user.email");
//         $query->execute();
//         $res = $query->fetchAll(PDO::FETCH_ASSOC);

//         if ($res || sizeof($res) == 0){
//             header('Content-Type: application/json; charset=utf-8');
//             echo json_encode($res);
//             $pdo = null;
//             break;
//         }

//         echo "error";
//         $pdo = null;
//         break;
//     }

    case 'add': {
        $query = $pdo->prepare('INSERT INTO task_data (text, deadline, reward, payment_method)
 VALUES (:text, :deadline, :reward, :payment_method)', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $is_done = $query->execute(['text' => $_POST['text'], 'deadline' => $_POST['deadline'], 'reward' => $_POST['reward'], 'payment_method' => $_POST['payment_method']]);
        if ($is_done) {
            $query = $pdo->prepare('SELECT idtask_data FROM task_data ORDER BY idtask_data DESC LIMIT 1');
            $query->execute();
            $id = $query->fetch(PDO::FETCH_BOTH);

            $query = $pdo->prepare('INSERT INTO feedback (freelancer_user_email, task_task_id, task_data_id)
 VALUES (:email, :id, :data_id)', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['email' => $_SESSION['email'], 'id' => $_POST['task_id'], 'data_id' => $id['idtask_data']]);

            header('Location: task?task_id='.$_POST['task_id']);
        }

        header('Location: ../');
    }

    case 'edit': {

    }

    case 'delete': {

    }
}