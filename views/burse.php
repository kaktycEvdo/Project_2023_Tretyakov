<script>
    let task_texts = '';
    let task_owners = '';
    function searchContent(){
        
    }
    fetch('php/process_tasks.php?action=getAll').
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

        for(i = 0; i < res.length; i++){
            const task_container =document.createElement('div');
            task_container.className = 'task_container';
            const name_field = document.createElement('div');
            name_field.innerHTML = res[i]['surname'] + " " + res[i]['name'][0] + ". " + res[i]['patronymic'][0] + "." + (res[i]['verified'] ? '<i class="verified-user">+</i>' : '');
            const text_field = document.createElement('div');
            text_field.innerHTML = res[i]['text'];
            const tags_field = document.createElement('div');
            tags_field.innerHTML = res[i]['tags'];
            const reward_field = document.createElement('div');
            reward_field.innerHTML = res[i]['reward']+"руб.";

            task_container.appendChild(name_field);
            task_container.appendChild(text_field);
            task_container.appendChild(tags_field);
            task_container.appendChild(reward_field);
            tasks_container.appendChild(task_container);
        }
        if(res.length === 0){
            tasks_container.innerHTML = "<div class='first_element'><a href='new_task'>Добавить свой заказ</a></div><div class='first_element'>Не было добавлено ни одного заказа(</div>";
        }
        loading.classList.add('hidden');
    })
</script>
<div class="loading" id="loading">Загрузка...</div>
<div class="tasks_container">
</div>