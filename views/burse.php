<script>
    task_texts = '';
    task_owners = '';
    function searchContent(){
        
    }
    fetch('php/process_tasks.php?action=getAll').
    then(response => {
        let res = response.json();
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            console.log('Error: not json returned')
        }
        
        return res;
    }, error => {
        console.log(error);
    }).then(res => {
        console.log();
        let name_field = document.getElementById('name');
        name_field.innerHTML = res['surname'] + " " + res['name'] + " " + res['patronymic'] + (res['verified'] ? '<i class="verified-user">+</i>' : '');
        
        const profile_about_field = document.querySelector('.profile_about > textarea');
        const chars_field = document.querySelector('.profile_charas > div:nth-child(2)');
    })
</script>
<div id="right_menu"><a href="new_task">Добавить свой заказ</a></div>
<div class="tasks_containter">
    Загрузка...
</div>