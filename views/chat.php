<?php if(!isset($_SESSION['user'])) header('Location: auth'); ?>
<div class="loading" id="loading">Загрузка...</div>
<div id="chat_container">
    <div id="history"></div>
    <div id="dialogue">
        <div class="messages">
            <div class="others">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum sint odit quasi? Earum ipsa inventore sunt aspernatur modi eaque placeat, ipsam laborum dignissimos enim illum quidem eius esse optio, magnam tenetur eos facilis quaerat. Et architecto in placeat incidunt sunt aut exercitationem facere nesciunt, voluptatum id cum accusamus ex officia, quam, atque perferendis autem magnam illo maiores adipisci minus asperiores! Alias laudantium quidem hic fugit, blanditiis harum facere doloribus. Quia repellat eligendi id doloremque voluptates. Facere, sint nesciunt culpa minus laborum quaerat nemo temporibus! Culpa inventore possimus alias atque. Vitae esse illo suscipit nam possimus, soluta amet! Illum libero dignissimos recusandae? Excepturi eveniet doloribus odio ex nobis incidunt natus. Veniam ratione dignissimos debitis neque dolores molestiae, natus distinctio eligendi necessitatibus tempora et obcaecati iusto modi voluptates laborum ut rerum corporis labore? Expedita praesentium eum, vel suscipit quisquam facere voluptatibus maiores, iusto ea fugiat possimus vitae dolor enim. Porro exercitationem deserunt doloremque cupiditate eveniet, eum reprehenderit. Magnam soluta, voluptate saepe repellat, quis maxime debitis illo magni maiores pariatur atque quidem veritatis cum recusandae repudiandae est adipisci officia nostrum unde, veniam quas reprehenderit nulla modi. Deserunt, obcaecati voluptas laborum natus officiis quam hic dolore, molestiae distinctio, ad molestias ab corporis eveniet perspiciatis!</div>
            <div class="others">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, quidem non. Nesciunt, magnam voluptatibus. Numquam!</div>
            <div class="others">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur illum laboriosam animi quod, maiores magni.</div>
            <div class="others">Lorem ipsum dolor sit amet.</div>
            <div class="yours">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti distinctio aliquam nemo iste ipsam est sed explicabo exercitationem sequi nobis.</div>
            <div class="yours">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae, quasi cum quos necessitatibus vel suscipit.</div>
            <div class="others">Lorem, ipsum.</div>
            <div class="others">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat labore, commodi sit, suscipit quod quam unde, animi porro nesciunt adipisci rerum. Molestias voluptate ullam enim, officia eaque totam aperiam porro.</div>
            <div class="others">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi hic soluta, autem cupiditate maiores esse?</div>
        </div>
        <div class="inputs">
        <input name="text" id="text" type="text" value="" maxlength="2000" />
        <label for="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></label>
        <input type="submit" id="submit" value="" hidden>
        <input type="hidden" value={{ $recepient['id'] }} />
        </div>
    </div>
</div>
<script>
    var chosenUser = '';

    // отправляет сообщение
    function sendMessage(){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", '../php/process_messages.php?action=add', true);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // создать сообщение когда отправилось
            }
            if (xhr.readyState === XMLHttpRequest.UNSENT){
                popup('error', 'Error: message wasn\'t sent');
            }
        };

        let data = {
            'author': '<?php echo $_SESSION['user']; ?>',
            'recepient': chosenUser,
            'text': document.getElementsByName('message_text')[0].value
        }

        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(data);
    }
    // изменяет сообщение
    function updateMessage(){

    }
    // показывает диалог
    function displayDialogue(id){
        chosenUser = id;
    }
    // показывает список диалогов
    function displayList(hide = false){
        if(hide){

        }
        else{

        }
    }
    // обновляет диалог
    function updateMessages(){
        fetch('../php/process_messages.php?action=getAll').
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
            for(let i = 0; i < data.length; i++){
                let dialogue = document.createElement('a');
                dialogue.innerHTML = res[i]['surname'] + " " + res[i]['name'][0] + ". " + (res[i]['patronymic'] ? (res[i]['patronymic'][0] + ".") : '') + (data['verified'] ? '<i class="verified-user">+</i>' : '');

                dialogues.appendChild(dialogue);
            }

            const loading = document.querySelector('#loading');

            loading.classList.add('hidden');
        })
    }
    updateMessages();
    setInterval(updateMessages, 5000);
    
</script>