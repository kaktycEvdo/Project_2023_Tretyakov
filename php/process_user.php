<?php
include_once "connect_to_db.php";

// login or email auth
if (!empty($_POST["loginoremail"])){
    $query = $pdo->prepare("SELECT login FROM user, personal_data WHERE (personal_data_login=:login or email=:login) and personal_data.password=:password", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $query->execute(['login' => $_POST['loginoremail'], 'password' => $_POST['password']]);
    $res = $query->fetch(PDO::FETCH_ASSOC);

    if ($res){
        $_SESSION['user'] = $res['login'];
        $pdo = null;
        header("Location: ../app.php?page=index");
        exit();
    }

    $pdo = null;
    header("Location: ../app.php?page=auth", $response_code = 401);
}

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

    $_SESSION['user'] = $_POST['login'];
    $pdo = null;
    header("Location: ../app.php?page=index");
    exit();
}


$pdo = null;
header("Location: ../app.php?page=reg", $response_code = 401);