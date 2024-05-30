<script>
    function updateHeader(){
        const headerContainer = document.querySelector("header");

        const pic = document.getElementById('profile_image_container');

        if(localStorage.getItem("role") === "zak" || !localStorage.getItem("role")){
            headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
            <div class='hmenu'>
                <a href="/">Главная</a>
                <a href="freelancers"'>Исполнители</a>
            </div>`
            headerContainer.appendChild(pic);
        }
        else if(localStorage.getItem("role") === "isp"){
            headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
            <div class='hmenu'>
                <a href="/"'>Главная</a>
                <a href="burse">Биржа</a>
            </div>`
            headerContainer.appendChild(pic);
        }
    }

    let profile = {};

    fetch('php/process_user.php?action=get<?php echo $profile ? '&profile='.$profile : '' ?>').
    then(response => {
        profile = response.json();
        let map = {};

        for (let i = 0; i < profile.length; i++) {
            map[profile[i].id] = profile[i];
        }
        console.log(map);
    }, error => {
        console.log(error);
    })
</script>
<div class="profile_container">
    <div class="profile_brief">
        <div class="profile_name_img">
            <img src="static/e93161a711d78c374f9a863188be1edc.jpg">
            <div></div>
        </div>
        <div class="profile_brief_buttons">
            <a onclick='localStorage.role = "isp"; updateHeader();'>Исполнитель</a>
            <a onclick='localStorage.role = "zak"; updateHeader();'>Заказчик</a>
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