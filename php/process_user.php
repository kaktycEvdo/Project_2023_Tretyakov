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
        if(!isset($_GET['role'])){
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
        if($_GET['role'] == 'freelancer'){
            $query = $pdo->prepare("SELECT name, surname, patronymic, verified,
 freelancer.about as freelancer_about, freelancer.characteristics as freelancer_chars, personal_data.login as login
 FROM user, freelancer, personal_data WHERE freelancer.user_email = email and user.personal_data_login = personal_data.login");
        }
        else{
            $query = $pdo->prepare("SELECT name, surname, patronymic, verified,
 purchaser.about as purchaser_about, purchaser.characteristics as purchaser_chars, purchaser.user_email as email
 FROM user, purchaser");
        }
        
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

    case "update": {
        if(isset($_SESSION["user"])){
            $query = $pdo->prepare("SELECT login, email FROM user, personal_data WHERE (personal_data_login=:login or email=:login) and personal_data.password=:password", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        }
    }

    case 'auth': {
        $query = $pdo->prepare("SELECT login, email FROM user, personal_data WHERE (personal_data_login=:login or email=:login) and personal_data.password=:password", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $query->execute(['login' => $_POST['loginoremail'], 'password' => $_POST['password']]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        if ($res){
            $_SESSION['user'] = $res['login'];
            $_SESSION['email'] = $res['email'];
            $pdo = null;
            break;
        }

        $pdo = null;
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
            VALUES (:email, '', 'Я только что создал аккаунт!')", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['email' => $_POST['email']]);

            $query = $pdo->prepare("INSERT INTO purchaser (user_email, characteristics, about)
            VALUES (:email, '', 'Я только что создал аккаунт!')", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $query->execute(['email' => $_POST['email']]);
        
            $_SESSION['user'] = $_POST['login'];
            $_SESSION['email'] = $_POST['email'];
            $pdo = null;
            header('Location: ../profile');
            break;
        }

        $pdo = null;
        header('Location: ../reg');
        break;
    }
    
    case 'logout':{
        $query = $pdo->prepare("UPDATE user SET last_online = CURRENT_TIME WHERE personal_data_login=:login", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $res = $query->execute(['login' => $_SESSION['user']]);

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