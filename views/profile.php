<?php if(!isset($_SESSION['user'])) header('Location: auth'); ?>
<script>
    var fabout = 'Загрузка...';
    var pabout = 'Загрузка...';
    var fchars = 'Загрузка...';
    var pchars = 'Загрузка...';
    var feedbacks = [];
    var tasks = [];
    var official_tasks = [];

    function showFreelancer() {
        const specific_items = document.querySelector('.specific_items');
        const of_tasks = document.querySelector('.official_tasks');
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

        if(specific_items.innerHTML) specific_items.innerHTML = '';
        if(feedbacks.length > 0){
            feedbacks.forEach(feedback => {
                let fd_about = feedback['text'];
                let fd_reward = feedback['reward'];

                let container = document.createElement('a');
                container.href = 'task?task_id='+feedback['task_task_id'];
                container.className = 'task_container';
                container.innerHTML = '<div>'+fd_about+'</div><div>'+fd_reward+'руб.</div>'
                specific_items.appendChild(container);
            });
        }
        else{
            specific_items.innerHTML = 'Нету(';
        }
        if(of_tasks.innerHTML) of_tasks.innerHTML = '';
        if(official_tasks.length > 0){
            official_tasks.forEach(task => {
                let ts_about = task['text'];
                let ts_reward = task['reward'];

                let container = document.createElement('a');
                container.href = 'official_tasks?task_id='+task['task_id'];
                container.className = 'task_container';
                container.innerHTML = '<div>'+ts_about+'</div><div>'+ts_reward+'руб.</div>'
                of_tasks.appendChild(container);
            });
        }
        else{
            of_tasks.innerHTML = 'Нету(';
        }
    }
    function showPurchaser(){
        const specific_items = document.querySelector('.specific_items');
        const of_tasks = document.querySelector('.official_tasks');
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

        if(specific_items.innerHTML) specific_items.innerHTML = '';
        if(tasks.length > 0){
            tasks.forEach(task => {
                let ts_about = task['text'];
                let ts_reward = task['reward'];

                let container = document.createElement('a');
                container.href = 'task?task_id='+task['task_id'];
                container.className = 'task_container';
                container.innerHTML = '<div>'+ts_about+'</div><div>'+ts_reward+'руб.</div>'
                specific_items.appendChild(container);
            });
        }
        else{
            specific_items.innerHTML = 'Нету(';
        }
        if(of_tasks.innerHTML) of_tasks.innerHTML = '';
        if(official_tasks.length > 0){
            official_tasks.forEach(task => {
                let ts_about = task['text'];
                let ts_reward = task['reward'];

                let container = document.createElement('a');
                container.href = 'official_tasks?task_id='+task['task_id'];
                container.className = 'task_container';
                container.innerHTML = '<div>'+ts_about+'</div><div>'+ts_reward+'руб.</div>'
                of_tasks.appendChild(container);
            });
        }
        else{
            of_tasks.innerHTML = 'Нету(';
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
            showPurchaser();
        }
        else if(localStorage.getItem("role") === "isp"){
            // header update
            headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
            <div class='hmenu'>
                <a href='/'>Главная</a>
                <a href='burse'>Биржа</a>
            </div>`
            headerContainer.appendChild(pic);
            showFreelancer();
        }
    }
    fetch('php/process_user.php?action=get<?php echo isset($_GET['profile_id']) ? '&login='.$_GET['profile_id'] : '' ?>').
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

        feedbacks = profile['feedbacks'];
        tasks = profile['tasks'];
        official_tasks = profile['official_tasks'];

        if(localStorage.role === 'isp'){
            showFreelancer();
        }
        else if(localStorage.role === 'zak'){
            showPurchaser();
        }

        loading.classList.add('hidden');
    });
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
                    echo "<a href='settings?profile_id=".$_SESSION['user']."'>Настройки</a>";
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
<h4>Заказы/отклики:</h4>
<div class="tasks_container specific_items">
    <div>
        Загрузка...
    </div>
</div>
<h4>Ассоциируемые с пользователем официальные заказы:</h4>
<div class="tasks_container official_tasks">
    <div>
        Загрузка...
    </div>
</div>