<script>
    function updateHeader(){
        const headerContainer = document.querySelector("header");

        const pic = document.getElementById('profile_image_container');

        if(localStorage.getItem("role") === "zak" || !localStorage.getItem("role")){
            headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
            <div class='hmenu'>
                <a href='/'>Главная</a>
                <a href='freelancers'>Исполнители</a>
            </div>`
            headerContainer.appendChild(pic);
        }
        else if(localStorage.getItem("role") === "isp"){
            headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
            <div class='hmenu'>
                <a href='/'>Главная</a>
                <a href='burse'>Биржа</a>
            </div>`
            headerContainer.appendChild(pic);
        }
    }
    fetch('php/process_user.php?action=get<?php echo @$_GET['profile_id'] ? '&profile='.$_GET['profile_id'] : '' ?>').
    then(response => {
        let profile = response.json();
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            console.log('Error: not json returned')
        }
        
        return profile;
    }, error => {
        console.log(error);
    }).then(profile => {
        let name_field = document.getElementById('name');
        name_field.innerHTML = profile['surname'] + " " + profile['name'] + " " + profile['patronymic'] + (profile['verified'] ? '<i class="verified-user"></i>' : '');
        let profile_about_field = document.querySelector('.profile_about > textarea');
        profile_about_field.value = profile['about'];
        let chars_field = document.querySelector('.profile_charas > div:nth-child(2)')
        for(let i = 0; i < profile['chars'].split(', ').length; i++){
            
        }
    })
</script>
<div class="profile_container">
    <div class="profile_brief">
        <div class="profile_name_img">
            <img src="static/e93161a711d78c374f9a863188be1edc.jpg">
            <div id="name">Загрузка...</div>
        </div>
        <div class="profile_brief_buttons">
            <a onclick='localStorage.role = "isp"; updateHeader();'>Исполнитель</a>
            <a onclick='localStorage.role = "zak"; updateHeader();'>Заказчик</a>
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
                <div>💖Хулиганом</div>
                <div>Атакованный</div>
                <div>Компьютер</div>
                <div>Еле</div>
                <div>Работает✨</div>
            </div>
        </div>
    </div>
</div>