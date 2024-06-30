<form>
    <h2>Авторизация</h2>
    <div class="form_fields">
        <input required id="login" name="loginoremail" type="text" placeholder="Логин или электронная почта" />
        <input required id="password" name="password" type="password" placeholder="Пароль" />
    </div>
    <div class="form_bottom">
        <a href="reg">Регистрация</a>
        <input type="submit" value="Отправить"/>
    </div>
    <div id="error"></div>
</form>
<script>
    function sendPost(){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", '../php/process_user.php?action=auth', true);
        xhr.onreadystatechange = () => {
            // Call a function when the state changes.
            if (xhr.readyState === XMLHttpRequest.UNSENT){
                popup('error', 'Ошибка авторизации');
            }
            if (xhr.readyState === XMLHttpRequest.DONE){
                popup('success', 'Авторизация');
                window.location = 'profile';
            }
        };

        let data = 'loginoremail='+document.getElementsByName('loginoremail')[0].value+'&password='+document.getElementsByName('password')[0].value;

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }

    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        sendPost();
    });
</script>