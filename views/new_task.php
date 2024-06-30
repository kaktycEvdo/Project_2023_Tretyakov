<?php if(!isset($_SESSION['user'])) header('Location: ../'); ?>
<form method="POST" action="../php/process_tasks.php?task_id=<?php echo @$_GET['task_id'] ?>&action=<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? 'edit' : 'add' ?>">
    <div><h3>Заказ оформляет: <?php echo $_SESSION['user'] ?></h3></div>
    <div class="form_fields">
        <label>Текст заказа (200-2000 символов):</label>
        <textarea id="text" name="text" maxlength="2000" minlength="200" required autofocus style="resize: vertical; min-height: 30vh; max-height: 70vh;"></textarea>
        <label>Цена заказа (в рублях):</label>
        <input id="reward" name="reward" type="number" placeholder="0" min="0" max="1000000" required />
        <label>Метод оплаты:</label>
        <div class="radios">
            <label class="container">Предоплатой полностью
                <input checked id="payment_method1" value="0" name="payment_method" type="radio" hidden />
                <span class="checkmark"></span>
            </label>
            <label class="container">Оплатой частями во время выполнения
                <input id="payment_method2" value="1" name="payment_method" type="radio" hidden />
                <span class="checkmark"></span>
            </label>
            <label class="container">Оплатой полностью после выполнения
                <input id="payment_method3" value="2" name="payment_method" type="radio" hidden />
                <span class="checkmark"></span>
            </label>
        </div>
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
    if(<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? 'true' : 'false' ?>){
        fetch('../php/process_tasks.php?action=get&id=<?php echo @$_GET['task_id'] ?>')
        .then(response => {
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
        });
    }
</script>