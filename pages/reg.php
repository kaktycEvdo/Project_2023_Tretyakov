<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КФ</title>
    <link rel="stylesheet" href="static/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
</head>
<body>
    <div id="main">
        <script src="static/scripts.js"></script>
        <div class="main_content">
            <form>
                <h2>Регистрация</h2>
                <div>
                    <input required id="mail" name="mail" type="email" placeholder="Почта" />
                    <input required id="login" name="login" type="text" placeholder="Логин" />
                    <input required id="password" name="password" type="password" placeholder="Пароль" />
                    <input required id="passwordR" name="passwordR" type="password" placeholder="Пароль" />
                </div>
                <div>
                    <input required type="checkbox" name="oferta" id="oferta" />
                    <label for="oferta">текст текст текст текст текст</label>
                    <input required type="checkbox" name="konf" id="konf" />
                    <label for="konf">текст текст текст текст текст</label>
                </div>
                <input type="submit" value="Отправить"/>
            </form>
            <a href="auth.html">Авторизация</a>
        </div>
    </div>
</body>
</html>