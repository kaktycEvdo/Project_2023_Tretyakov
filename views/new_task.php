<!-- <script>
    
</script> -->
<form action="../php/process_tasks.php?action=add&profile=<?php echo $_SESSION['user'] ?>">
    <h3>Заказ оформляет: <?php echo $_SESSION['user'] ?></h3>
    <label>Текст заказа (200-2000 символов):</label>
    <textarea maxlength="2000" minlength="200"></textarea>
    <label>Цена заказа (в рублях):</label>
    <input type="number" placeholder="0" min="0" max="1000000" />
    <label>Желаемый дедлайн заказа:</label>
    <input type="datetime-local" />
    <input type="submit" value="Создать">
</form>