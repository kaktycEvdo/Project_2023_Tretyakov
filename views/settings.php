<?php isset($_SESSION['user']) ? null : header('Location: /') ?>
<script>
    fetch('php/process_user.php?action=getPersonal').
    then(response => {
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            window.location.replace("auth");
        }

        let profile = response.json();
        return profile;
    }, error => {
        console.log(error);
    }).then(profile => {
        const loading = document.querySelector('#loading');

        let fr_about = document.getElementById('fr-about');
        let fr_chars = document.getElementById('fr-chars');
        let pr_about = document.getElementById('pr-about');
        let pr_chars = document.getElementById('pr-chars');
        fr_about.innerHTML = profile['freelancer_about'];
        fr_chars.value = profile['freelancer_chars'];
        pr_about.innerHTML = profile['purchaser_about'];
        pr_chars.value = profile['purchaser_chars'];

        loading.classList.add('hidden');
    });
</script>
<div id="loading">Загрузка...</div>
<form method="POST" action="../php/process_user.php?action=update" class="profile_settings">
    <h2>Профиль фрилансера</h2>
    <div class="form_fields">
        <textarea name="fr-about" id="fr-about" style="resize: vertical; min-height: 20vh; max-height: 70vh;"></textarea>
        <input type="text" name="fr-chars" id="fr-chars" />
    </div>
    <h2>Профиль заказчика</h2>
    <div class="form_fields">
        <textarea name="pr-about" id="pr-about" style="resize: vertical; min-height: 20vh; max-height: 70vh;"></textarea>
        <input type="text" name="pr-chars" id="pr-chars" />
    </div>
    <div class="form_bottom">
        <input type="submit" name="submit" id="submit" value="Обновить" style="">
    </div>
</form>
<form method="POST" action="../php/process_user.php?action=delete" class="profile_settings" style="min-height: 200px">
    <h2>Карты</h2>
    <div class="form_bottom">
        <a href="cards" style="padding: 10px 20px; background-color: var(--background-color); border-top: var(--accent-color) 3px solid; cursor: pointer">Карты</a>
    </div>
    <h2>Документы и сертификаты</h2>
    <div class="form_bottom">
        <a href="documents" style="padding: 10px 20px; background-color: var(--background-color); border-top: var(--accent-color) 3px solid; cursor: pointer">Документы</a>
        <a href="certificates" style="padding: 10px 20px; background-color: var(--background-color); border-top: var(--accent-color) 3px solid; cursor: pointer">Сертификаты</a>
    </div>
    <h2>Удаление профиля</h2>
    <div class="form_bottom">
        <input type="submit" name="submit" id="submit" value="Удалить" style="border-top: 3px solid red">
    </div>
</form>