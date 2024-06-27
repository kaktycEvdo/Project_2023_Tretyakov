<?php if(!isset($_SESSION['user'])) header('Location: auth'); ?>
<script>
    var fabout = 'Загрузка...';
    var pabout = 'Загрузка...';
    var fchars = 'Загрузка...';
    var pchars = 'Загрузка...';

    function showFreelancer() {
        const profile_about_field = document.querySelector('.profile_about > textarea');
        const chars_field = document.querySelector('.profile_charas > div:nth-child(2)');
        profile_about_field.innerHTML = fabout;
        if(fchars){
            let str = '';
            fchars.split(', ').forEach(element => {
                str+='<div class="char">'+element+'</div>'
            });
            chars_field.innerHTML = str;
        }
        else{
            chars_field.innerHTML = "Нету";
        }
    }
    function showPurchaser(){
        const profile_about_field = document.querySelector('.profile_about > textarea');
        const chars_field = document.querySelector('.profile_charas > div:nth-child(2)');
        profile_about_field.innerHTML = pabout;
        if(pchars){
            let str = '';
            pchars.split(', ').forEach(element => {
                str+='<div class="char">'+element+'</div>'
            });
            chars_field.innerHTML = str;
        }
        else{
            chars_field.innerHTML = "Нету";
        }
    }

    function updateContent(){
        const headerContainer = document.querySelector("header");
        const profile_about_field = document.querySelector('.profile_about > textarea');
        const chars_field = document.querySelector('.profile_charas > div:nth-child(2)');

        const pic = document.getElementById('profile_image_container');

        if(localStorage.getItem("role") === "zak" || !localStorage.getItem("role")){
            // header update
            headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
            <div class='hmenu'>
                <a href='/'>Главная</a>
                <a href='freelancers'>Исполнители</a>
            </div>`
            headerContainer.appendChild(pic);
            // about + chars update
            profile_about_field.innerHTML = pabout;
            if(pchars){
                let str = '';
                pchars.split(', ').forEach(element => {
                    str+='<div class="char">'+element+'</div>'
                });
                chars_field.innerHTML = str;
            }
            else{
                chars_field.innerHTML = "Нету";
            }
        }
        else if(localStorage.getItem("role") === "isp"){
            // header update
            headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
            <div class='hmenu'>
                <a href='/'>Главная</a>
                <a href='burse'>Биржа</a>
            </div>`
            headerContainer.appendChild(pic);
            profile_about_field.innerHTML = fabout;
            if(fchars){
                let str = '';
                fchars.split(', ').forEach(element => {
                    str+='<div class="char">'+element+'</div>'
                });
                chars_field.innerHTML = str;
            }
            else{
                chars_field.innerHTML = "Нету";
            }
        }
    }
    fetch('php/process_user.php?action=get<?php echo @$_GET['profile_id'] ? '&login='.$_GET['profile_id'] : '' ?>').
    then(response => {
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            console.log('Error: not json returned')
            window.location.replace("auth");
        }

        let profile = response.json();
        return profile;
    }, error => {
        console.log(error);
    }).then(profile => {
        fabout = profile['freelancer_about'];
        pabout = profile['purchaser_about'];
        fchars = profile['freelancer_chars'];
        pchars = profile['purchaser_chars'];
        const loading = document.querySelector('#loading');

        let name_field = document.getElementById('name');
        name_field.innerHTML = profile['surname'] + " " + profile['name'] + " " + (profile['patronymic'] ? profile['patronymic'] : '') + (profile['verified'] ? '<i class="verified-user">+</i>' : '');

        if(localStorage.role === 'isp'){
            showFreelancer();
        }
        else{
            showPurchaser();
        }
        loading.classList.add('hidden');
    })

</script>
<div class="loading" id="loading">Загрузка...</div>
<div class="profile_container">
    <div class="profile_brief">
        <div class="profile_name_img">
            <img src="static/e93161a711d78c374f9a863188be1edc.jpg">
            <div id="name">Загрузка...</div>
        </div>
        <div class="profile_brief_buttons">
            <?php
                if (isset($_GET['profile_id']) && $_GET['profile_id']){
                    echo "<a href='chat?profile_id=".$_GET['profile_id']."'>Написать</a>";
                    echo "<a onclick='showFreelancer();'>Исполнитель</a>
                    <a onclick='showPurchaser();'>Заказчик</a>";
                }
                else{
                    echo "<a onclick='localStorage.role = \"isp\"; updateContent();'>Исполнитель</a>
                    <a onclick='localStorage.role = \"zak\"; updateContent();'>Заказчик</a>";
                }
            ?>
        </div>
    </div>
    <div>
        <div class="profile_about">
            <div>О себе:</div>
            <textarea disabled="">Загрузка...</textarea>
        </div>
        <div class="profile_charas">
            <div>Характеристики:</div>
            <div>
                <div>Загрузка...</div>
            </div>
        </div>
    </div>
</div>