<?php
    session_start();
    include_once '../php/connect_to_db.php';

    $query = $pdo->prepare('SELECT name, surname, patronymic, chars, about FROM');
?>
<div class="profile_container">
    <div class="profile_brief">
        <div class="profile_name_img">
            <img src="static/e93161a711d78c374f9a863188be1edc.jpg">
            <div>фамилия имя </div>
        </div>
        <div class="profile_brief_buttons">
            <a class="clickable" onclick='localStorage.role = "isp"; () => getPage("pages/auth.php"); createHeader();'>Исполнитель</a>
            <a class="clickable" onclick='localStorage.role = "zak"; () => getPage("pages/auth.php"); createHeader();'>Заказчик</a>
        </div>
    </div>
    <div>
        <div class="profile_about">
            <div>О себе:</div>
            <textarea disabled=""><?php  ?></textarea>
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