<script>
    let task_texts = [];
    let task_owners = [];
    let task_tags = [];
    var task_list = [];
    var searched_tasks = [];

    function update(){
        const tasks_container = document.getElementsByClassName('tasks_container')[0];
        tasks_container.innerHTML = "<div class='add_task'><a href='new_task'>Добавить свой заказ</a></div>";

        searched_tasks.forEach((id, _) => {
            const task_container = document.createElement('a');
            task_container.className = 'task_container';
            task_container.href = 'task?task_id='+task_list[id]['task_id'];
            const text_field = document.createElement('div');
            text_field.innerHTML = task_list[id]['text'];
            const tags_field = document.createElement('div');
            tags_field.innerHTML = task_list[id]['tags'];
            const reward_field = document.createElement('div');
            reward_field.innerHTML = task_list[id]['reward']+"руб.";

            task_container.appendChild(text_field);
            task_container.appendChild(tags_field);
            task_container.appendChild(reward_field);
            tasks_container.appendChild(task_container);
        });

        if(searched_tasks.length === 0){
            tasks_container.innerHTML = "<div class='add_task'><a href='new_task'>Добавить свой заказ</a></div><div class='no_tasks'>Не было найдено ни одного заказа(</div>";
        }
    }
    
    fetch('../php/process_tasks.php?action=getAll').
    then(response => {
        let res = response.json();
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            popup('error', 'Error: not json returned');
        }
        
        return res;
    }, error => {
        console.log(error);
    }).then(res => {
        const loading = document.getElementById('loading');

        let i = 0;

        res.forEach(task => {
            task_list.push(task);

            task_texts.push([i, task['text'].toLowerCase()]);
            task_owners.push([i, task['surname'].toLowerCase()]);
            task_tags.push([i, task['tags'].toLowerCase()]);
            searched_tasks.push(i);
            i++;
        });

        loading.classList.add('hidden');
    }).then(() => {
        update();
        var search_bar = document.getElementById('search_bar');
        function searchText(value){
            if(search_bar.value !== ''){
                task_texts.forEach(text => {
                    if(text[1].includes(value.toLowerCase())){
                        searched_tasks.push(text[0]);
                    }
                });
            }
            else{
                for (let i = 0; i < task_list.length; i++) {
                    searched_tasks.push(i);
                }
            }
        }
        function searchOwner(value){
            if(search_bar.value !== ''){
                task_owners.forEach(owner => {
                    if(owner[1].includes(value.toLowerCase())){
                        searched_tasks.push(owner[0]);
                    }
                });
            }
            else{
                for (let i = 0; i < task_list.length; i++) {
                    searched_tasks.push(i);
                }
            }
        }
        function searchTags(value){
            if(search_bar.value !== ''){
                task_tags.forEach(tag => {
                    if(tag[1].includes(value.toLowerCase())){
                        searched_tasks.push(tag[0]);
                    }
                });
            }
            else{
                for (let i = 0; i < task_list.length; i++) {
                    searched_tasks.push(i);
                }
            }
        }
        search_bar.addEventListener('input', (e) => {
            searched_tasks = [];
            switch (document.getElementsByName('search_term')[0].value) {
                case 'text':
                    searchText(e.target.value);
                    break;
                case 'owner':
                    searchOwner(e.target.value);
                    break;
                case 'tags':
                    searchTags(e.target.value);
                    break;
            }
            update();
        });
    })
</script>
<div class="loading" id="loading">Загрузка...</div>
<div class="search">
    <input type="text" id="search_bar" />
    <select name="search_term" id="search_term">
        <option value="text">
            По тексту
        </option>
        <option value="owner">
            По заказчику
        </option>
        <option value="tags">
            По тегам
        </option>
    </select>
</div>
<div class="tasks_container">
</div>