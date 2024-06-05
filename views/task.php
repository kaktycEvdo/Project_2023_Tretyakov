<script>    
    fetch('php/process_tasks.php?action=get&id=<?php echo $_GET['task_id'] ?>').
    then(response => {
        let res = response.json();
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            console.log('Error: not json returned');
        }
        
        return res;
    }, error => {
        console.log(error);
    }).then(res => {
        const loading = document.getElementById('loading');

        const task_container = document.getElementsByClassName('task_container')[0];
        const name_field = document.getElementsByClassName('name_container')[0];
        name_field.innerHTML = '<img>' + res['surname'] + " " + res['name'][0] + ". " + res['patronymic'][0] + "." + (res['verified'] ? '<i class="verified-user">+</i>' : '');
        const text_field = document.createElement('div');
        text_field.innerHTML = res['text'];
        const deadline_field = document.createElement('div');
        deadline_field.innerHTML = 'Сделать до: '+res['deadline'];
        const reward_field = document.createElement('div');
        reward_field.innerHTML = ''+res['reward']+"руб.";

        const tags_field = document.createElement('div');
        let tags = res['tags'].split(', ');
        tags_field.className = 'tags';
        
        for (let i = 0; i < tags.length; i++){
            tags_field.innerHTML+='<div class="tag">'+tags[i]+'</div>';
        }

        task_container.appendChild(text_field);
        task_container.appendChild(tags_field);
        task_container.appendChild(reward_field);
        task_container.appendChild(deadline_field);

        if(localStorage.getItem('role') === 'isp' && res['login'] !== '<?php echo $_SESSION['user']; ?>'){
            const feedback_button = document.createElement('a');
            feedback_button.innerHTML = "Откликнуться";
            feedback_button.href = "new_feedback.php?task_id="+'<?php echo $_GET['task_id'] ?>';
            feedback_button.className = 'feedback_button';

            document.body.appendChild(feedback_button);
        }
        else if (res['login'] === '<?php echo $_SESSION['user']; ?>'){
            const feedback_button = document.createElement('a');
            feedback_button.innerHTML = "Отредактировать";
            feedback_button.href = "new_task.php?action=edit&task_id="+'<?php echo $_GET['task_id'] ?>';
            feedback_button.className = 'feedback_button';

            document.body.appendChild(feedback_button);
        }
        
        loading.classList.add('hidden');
    })
</script>
<div class="loading" id="loading">Загрузка...</div>
<div class="name_container">
</div>
<div class="task_container">
    
</div>