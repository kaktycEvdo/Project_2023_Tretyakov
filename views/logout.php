<div class="loading" id="loading">Загрузка...</div>
<div id="logout_page">
    <div class="profile_container profile_card">
        <div class="profile_brief">
            <div class="profile_name_img">
                <img src="static/e93161a711d78c374f9a863188be1edc.jpg">
                <div id="name">Загрузка...</div>
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
    <div class="sure">
        <h4>Точно выйти?</h4>
        <div>
            <button onclick="history.back()">Нет</button>
            <button>Да</button>
        </div>
    </div>
</div>
<script>
    var fabout = 'Загрузка...';
    var pabout = 'Загрузка...';
    var fchars = 'Загрузка...';
    var pchars = 'Загрузка...';

    function updateContent(){
        const profile_about_field = document.querySelector('.profile_about > textarea');
        const chars_field = document.querySelector('.profile_charas > div:nth-child(2)');

        const pic = document.getElementById('profile_image_container');

        if(localStorage.getItem("role") === "zak" || !localStorage.getItem("role")){
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
        fabout = profile['freelancer_about'];
        pabout = profile['purchaser_about'];
        fchars = profile['freelancer_chars'];
        pchars = profile['purchaser_chars'];

        let name_field = document.getElementById('name');
        name_field.innerHTML = profile['surname'] + " " + profile['name'] + " " + profile['patronymic'] + (profile['verified'] ? '<i class="verified-user">+</i>' : '');
        
        const profile_about_field = document.querySelector('.profile_about > textarea');
        const chars_field = document.querySelector('.profile_charas > div:nth-child(2)');
        const loading = document.querySelector('#loading');

        if(localStorage.role === 'isp'){
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
        else{
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
        loading.classList.add('hidden');
    })
    const logout_button = document.querySelector('#logout_page .sure div > :nth-child(2)');
    logout_button.addEventListener('click', () => {

    })
</script>