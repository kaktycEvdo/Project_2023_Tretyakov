<form method="POST" action="../php/process_user.php">
    <h2>Авторизация</h2>
    <div class="form_fields">
        <input required id="login" name="loginoremail" type="text" placeholder="Логин или электронная почта" />
        <input required id="password" name="password" type="password" placeholder="Пароль" />
    </div>
    <div class="form_bottom">
        <a href="?page=reg">Регистрация</a>
        <input type="submit" value="Отправить"/>
    </div>
</form>