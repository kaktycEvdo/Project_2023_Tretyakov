<?php
    session_start();
    include_once '../php/connect_to_db.php';

    var_dump($_SESSION['user']);

    $query = $pdo->prepare('SELECT name, surname, patronymic FROM user WHERE personal_data_login = :login', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $query->execute(['login' => $_SESSION['user']]);
    $res = $query->fetch(PDO::FETCH_ASSOC);

    if (!$res){
        http_response_code(401);
        exit();
    }
?>
<div class="profile_container">
    <div class="profile_brief">
        <div class="profile_name_img">
            <img src="static/e93161a711d78c374f9a863188be1edc.jpg">
            <div><?php echo $res['surname'].$res['name'].$res['patronymic'] ?></div>
        </div>
        <div class="profile_brief_buttons">
            <a class="clickable" onclick='localStorage.role = "isp"; () => getPage("pages/auth.php"); createHeader();'>Исполнитель</a>
            <a class="clickable" onclick='localStorage.role = "zak"; () => getPage("pages/auth.php"); createHeader();'>Заказчик</a>
        </div>
    </div>
    <div>
        <div class="profile_about">
            <div>О себе:</div>
            <textarea disabled="">WIP</textarea>
        </div>
        <div class="profile_charas">
            <div>Характеристики:</div>
            <div>
                <div>💖Хулиганом</div>
                <div>Атакованный</div>
                <div>Компьютер</div>
                <div>Еле</div>
                <div>Работает✨</div>
            </div>
        </div>
    </div>
</div>