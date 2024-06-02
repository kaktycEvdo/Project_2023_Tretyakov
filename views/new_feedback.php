<!-- <script>
    
</script> -->
<form action="../php/process_feedbacks.php?action=add&profile=<?php echo $_SESSION['user'] ?>">
    <h3>Отклик оформляет: <?php echo $_SESSION['user'] ?></h3>
    <label>Текст отклика (50-2000 символов):</label>
    <textarea maxlength="2000" minlength="50" required autofocus style="resize: vertical; width: 80%; height: 30%; font-size: 1.2em;"></textarea>
    <label>Цена вашей услуги (в рублях):</label>
    <input type="number" placeholder="0" min="0" max="1000000" required />
    <label>Желаемый дедлайн:</label>
    <input type="datetime-local" required />
    <input type="submit" value="Создать">
</form>