<form>
    <div><h3>Заказ оформляет: <?php echo $_SESSION['user'] ?></h3></div>
    <div class="form_fields">
        <label>Текст заказа (200-2000 символов):</label>
        <textarea id="text" name="text" maxlength="2000" minlength="200" required autofocus style="resize: vertical; min-height: 30vh; max-height: 70vh; font-size: 1.2em;"></textarea>
        <label>Цена заказа (в рублях):</label>
        <input id="reward" name="reward" type="number" placeholder="0" min="0" max="1000000" required />
        <label>Желаемый дедлайн заказа:</label>
        <input id="deadline" name="deadline" type="datetime-local" required />
        <label>Теги заказа (через запятую и пробел):</label>
        <input id="tags" name="tags" type="text" />
    </div>
        <div class="form_bottom">
            <i></i>
            <input type="submit" value="Создать">
    </div>
</form>
<script>
    if(<?php echo $_GET['action'] == 'edit'; ?>){
        fetch('../php/process_tasks.php?action=get&id=<?php echo @$_GET['task_id'] ?>')
        .then(res => {
            let res = response.json();
            if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
                console.log('Error: not json returned');
            }
            
            return res;
        })
        .then(res => {
            document.getElementsByName('text')[0].value = res['text'];
            document.getElementsByName('reward')[0].value = res['reward'];
            document.getElementsByName('deadline')[0].value = res['deadline'];
            document.getElementsByName('tags')[0].value = res['tags'];
        })
    }
    function sendPost(){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", '../php/process_tasks.php?action=add', true);
        xhr.onreadystatechange = () => {
            // Call a function when the state changes.
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                
            }
            if (xhr.readyState === XMLHttpRequest.UNSENT){
                
            }
        };

        let data = "text="+document.getElementsByName('text')[0].value+"&reward="+document.getElementsByName('reward')[0].value+"&deadline="+document.getElementsByName('deadline')[0].value+"&tags="+document.getElementsByName('tags')[0].value;

        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(data)
    }

    const form = document.getElementsByTagName('form')[0];
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        sendPost();
    });
</script>