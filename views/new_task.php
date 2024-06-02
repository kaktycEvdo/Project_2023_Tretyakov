<!-- <script>
    
</script> -->
<form method="POST" action="../php/process_tasks.php?action=add&profile=<?php echo $_SESSION['email'] ?>">
<div><h3>Заказ оформляет: <?php echo $_SESSION['user'] ?></h3></div>
<div class="form_fields">
    <label>Текст заказа (200-2000 символов):</label>
    <textarea name="text" maxlength="2000" minlength="200" required autofocus style="resize: vertical; min-height: 30vh; max-height: 70vh; font-size: 1.2em;"></textarea>
    <label>Цена заказа (в рублях):</label>
    <input name="reward" type="number" placeholder="0" min="0" max="1000000" required />
    <label>Желаемый дедлайн заказа:</label>
    <input name="deadline" type="datetime-local" required />
    <label>Теги заказа (через запятую и пробел):</label>
    <input name="tags" type="text" />
</div>
    <div class="form_bottom">
        <i></i>
        <input type="submit" value="Создать">
    </div>
    
</form>