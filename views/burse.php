<script>
    task_texts = '';
    task_owners = '';
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
        let tasks_containter = document.getElementsByClassName('tasks_containter')[0];
        for(i = 0; i < res.length; i++){
            let name_field = document.createElement('div');
            name_field.innerHTML = res['surname'] + " " + res['name'] + " " + res['patronymic'] + (res['verified'] ? '<i class="verified-user">+</i>' : '');
            let text_field = document.createElement('div');
            text_field.innerHTML = res['about'];
            let tags_field = document.createElement('div');
            tags_field.innerHTML = res['tags'];
            let reward_field = document.createElement('div');
            reward_field.innerHTML = res['reward']+"руб.";

            tasks_containter.appendChild(name_field);
            tasks_containter.appendChild(text_field);
            tasks_containter.appendChild(tags_field);
            tasks_containter.appendChild(reward_field);
        }
        if(res.length === 0){
            tasks_containter.innerHTML = "Ещё не были опубликованы заказы(";
        }
    })
</script>
<div id="right_menu"><a href="new_task">Добавить свой заказ</a></div>
<div class="tasks_containter">
    Загрузка...
</div>