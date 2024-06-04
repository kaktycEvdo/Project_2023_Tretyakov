<script>    
    fetch('php/process_tasks.php?action=get').
    then(response => {
        let res = response.json();
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            console.log('Error: not json returned');
        }
        
        return res;
    }, error => {
        console.log(error);
    }).then(res => {
        const tasks_container = document.getElementsByClassName('tasks_container')[0];
        tasks_container.innerHTML = "<div class='first_element'><a href='new_task'>Добавить свой заказ</a></div>";
        const loading = document.getElementById('loading');

        const task_container = document.getElementsByClassName('task_container')[0];
        const name_field = document.createElement('div');
        name_field.innerHTML = res['surname'] + " " + res['name'][0] + ". " + res['patronymic'][0] + "." + (res['verified'] ? '<i class="verified-user">+</i>' : '');
        const text_field = document.createElement('div');
        text_field.innerHTML = res['text'];
        const tags_field = document.createElement('div');
        tags_field.innerHTML = res['tags'];
        const reward_field = document.createElement('div');
        reward_field.innerHTML = res['reward']+"руб.";

        task_container.appendChild(name_field);
        task_container.appendChild(text_field);
        task_container.appendChild(tags_field);
        task_container.appendChild(reward_field);
        
        loading.classList.add('hidden');
    })
</script>
<div class="loading" id="loading">Загрузка...</div>
<div class="task_container">
</div>