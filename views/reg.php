<form method="POST" action="../php/process_user.php?action=reg">
    <h2>Регистрация</h2>
    <div class="form_fields f1">
        <h3>Заполните конфиденциальные данные</h3>
        <input required id="email" name="email" type="email" placeholder="Почта" maxlength="70" />
        <input required id="login" name="login" type="text" placeholder="Логин" maxlength="40" />
        <input required id="phone" name="phone" type="text" placeholder="Телефон" data-phone-pattern = "+7 (___) ___-__-__" />
        <input required id="password" name="password" type="password" placeholder="Пароль" maxlength="40" />
        <input required id="passwordR" name="passwordR" type="password" placeholder="Повтор пароля" maxlength="40" />
    </div>
    <div class="form_fields f1">
        <input required type="checkbox" name="oferta" id="oferta" />
        <label for="oferta">текст текст текст текст текст</label>
        <input required type="checkbox" name="konf" id="konf" />
        <label for="konf">текст текст текст текст текст</label>
    </div>
    <div class="form_bottom f1">
        <a href="auth">Авторизация</a>
        <a class="nextstep">Дальше</a>
    </div>
    <div class="form_fields f2">
        <h3>Заполните персональные данные</h3>
        <input required id="name" name="name" type="text" placeholder="Имя" maxlength="52" />
        <input required id="surname" name="surname" type="text" placeholder="Фамилия" maxlength="52" />
        <input id="patronymic" name="patronymic" type="text" placeholder="Отчество" maxlength="52" />
    </div>
    <div class="form_bottom f2">
        <a href="auth">Авторизация</a>
        <input type="submit" value="Отправить"/>
    </div>
    <div id="error" class="hidden"></div>
</form>