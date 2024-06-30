<?php if(!isset($_SESSION['user'])) header('Location: auth'); ?>
<div class="loading" id="loading">Загрузка...</div>
<div id="chat_container">
    <div id="history"></div>
    <div id="dialogue">
        <div class="messages">
            
        </div>
        <div class="inputs">
        <input name="message_text" id="text" type="text" value="" maxlength="2000" />
        <label for="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></label>
        <input type="submit" id="submit" value="" hidden>
        </div>
    </div>
</div>
<script>
    var chosenUser = '<?php echo isset($_GET['profile_id']) ? $_GET['profile_id'] : null ?>';

    let button = document.getElementById('submit');

    // отправляет сообщение
    function sendMessage(){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", 'php/process_messages.php?action=add', true);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                popup('success', 'Сообщение отправлено');
            }

            if (xhr.readyState === XMLHttpRequest.UNSENT){
                popup('error', 'Error: message wasn\'t sent');
            }
        };

        let data = 'recepient=<?php echo isset($_GET['profile_id']) ? $_GET['profile_id'] : null ?>&text='+document.getElementsByName('message_text')[0].value;

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }
    button.addEventListener('click', sendMessage);
    // показывает список диалогов
    function displayList(hide = false){
        if(hide){

        }
        else{

        }
    }
    // обновляет диалог
    function updateMessages(){
        fetch('php/process_messages.php?action=getAll&id='+chosenUser).
        then(response => {
            let data = response.json();
            if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
                popup('error', 'Error: not JSON returned');
            }
            
            return data;
        }, error => {
            popup('error', error);
        }).then(data => {
            const dialogues = document.getElementById('history');
            dialogues.innerHTML = '';
            data['dialogues'].forEach(d => {
                let dialogue = document.createElement('a');
                dialogue.className = 'recepient';
                dialogue.href = '?profile_id='+d['login'];
                
                if (d['login'] === chosenUser) dialogue.classList.add('selected_recepient')
                dialogue.innerHTML = "<img src='static/e93161a711d78c374f9a863188be1edc.jpg' />"+d['surname'] + " " + d['name'][0] + ". " + (d['patronymic'] ? (d['patronymic'][0] + ".") : '') + (data['verified'] ? '<i class="verified-user">+</i>' : '');

                dialogues.appendChild(dialogue); 
            });

            const loading = document.querySelector('#loading');

            loading.classList.add('hidden');

            const messages = document.querySelector('.messages');
            messages.innerHTML = '';

            data['messages'].forEach(message => {
                let message_box = document.createElement('div');
                
                if (message['user_author'] === '<?php echo $_SESSION['user'] ?>') message_box.className = 'yours';

                message_box.innerHTML = message['text'];

                messages.appendChild(message_box);
            });
        })
    }
    updateMessages();
    setInterval(updateMessages, 5000);
    
</script>