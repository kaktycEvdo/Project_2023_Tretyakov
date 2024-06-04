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
        <div class="inputs"></div>
    </div>
</div>
<script>
    var chosenUser = '';

    // отправляет сообщение
    function sendMessage(){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", '../php/process_user.php?action=auth', true);
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
    function displayList(){

    }
    setInterval(() => {
        fetch('php/process_messages.php?action=getAll').
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
                dialogue.innerHTML = data['surname'] + " " + data['name'][0] + ". " + data['patronymic'][0] + ". " + (data['verified'] ? '<i class="verified-user">+</i>' : '');

                dialogues.appendChild(dialogue);
            }

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
    }, 5000);
    
</script>