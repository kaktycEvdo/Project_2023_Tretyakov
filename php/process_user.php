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
        $query = $pdo->prepare("SELECT name, surname, patronymic, verified,
 freelancer.about as freelancer_about, purchaser.about as purchaser_about, freelancer.characteristics as freelancer_chars, purchaser.characteristics as purchaser_chars
 FROM user, freelancer, purchaser");
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

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

    case 'getByRole': {
        if($_GET['role'] != 'purchaser' || $_GET['role'] != 'freelancer'){
            echo "error";
            $pdo = null;
            break;
        }
        $query = $pdo->prepare("SELECT *, user.name, user.surname, user.patronymic FROM :table, user WHERE user.email = :table.user_email and user.personal_data_login=:login", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        // надо будет подумать подольше над get или post здесь
        $_GET['login']
        ? $query->execute(['login' => $_GET['login'], 'table' => $_GET['role']])
        : $query->execute(['login' => $_SESSION['user'], 'table' => $_GET['role']]);
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

    case 'getAllByRole': {
        $query = $pdo->prepare("SELECT * FROM :table, user WHERE user.email = :table.user_email");
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

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

    case 'auth': {
        $query = $pdo->prepare("SELECT login FROM user, personal_data WHERE (personal_data_login=:login or email=:login) and personal_data.password=:password", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['login' => $_POST['loginoremail'], 'password' => $_POST['password']]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        if ($res){
            $_SESSION['user'] = $res['login'];
            $pdo = null;
            header("Location: ../");
            break;
        }

        $pdo = null;
        header("Location: ../auth", $response_code = 401);
        break;
    }

    case 'reg':{
        $query = $pdo->prepare("INSERT INTO personal_data (login, password) VALUES (:login, :password)", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $res = $query->execute(['login' => $_POST['login'], 'password' => $_POST['password']]);
        
        if ($res){
            if($_POST["patronymic"]){
                $query = $pdo->prepare("INSERT INTO user (email, name, surname, patronymic, phone, personal_data_login)
                VALUES (:email, :name, :surname, :patronymic, :phone, :login)", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        
                $query->execute(['email' => $_POST['email'], 'name' => $_POST['name'],
                'surname' => $_POST['surname'], 'patronymic' => $_POST['patronymic'],
                'phone' => $_POST['phone'], 'login' => $_POST['login']]);
            }
            else{
                $query = $pdo->prepare("INSERT INTO user (email, name, surname, phone, personal_data_login)
                VALUES (:email, :name, :surname, :phone, :login)", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        
                $query->execute(['email' => $_POST['email'], 'name' => $_POST['name'],
                'surname' => $_POST['surname'], 'phone' => $_POST['phone'],
                'login' => $_POST['login']]);
            }

            $query = $pdo->prepare("INSERT INTO freelancer (user_email, characteristics, about)
            VALUES (:email, '', '')", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['email' => $_POST['email']]);

            $query = $pdo->prepare("INSERT INTO purchaser (user_email, characteristics, about)
            VALUES (:email, '', '')", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['email' => $_POST['email']]);
        
            $_SESSION['user'] = $_POST['login'];
            $pdo = null;
            header("Location: ../");
            break;
        }

        $pdo = null;
        header("Location: ../reg", $response_code = 401);
        break;
    }
    
    case 'logout':{
        $query = $pdo->prepare("UPDATE last_login = NOW() IN user WHERE personal_data_login=:login", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['login' => $_SESSION['user']]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        if ($res){
            $_SESSION['user'] = null;
            $pdo = null;
            header("Location: ../");
            break;
        }

        $pdo = null;
        header("Location: ../auth", $response_code = 401);
        break;
    }
}