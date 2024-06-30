<script>
    feedbacks = [];
    fetch('../php/process_tasks.php?action=get&id=<?php echo $_GET['task_id'] ?>').
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

        const task_container = document.getElementsByClassName('task_container')[0];
        const info_container = document.createElement('div');
        const buttons_container = document.createElement('div');

        const name_field = document.querySelector('.pr.name_container');
        name_field.innerHTML = '<div><img src="/static/images.jpg">' + res['surname'] + " " + res['name'][0] + ". " + (res['patronymic'] ? res['patronymic'][0]+'. ' : '') + (res['verified'] ? '<i class="verified-user">+</i>' : '') + '</div><div title="Кол-во незакрытых заказов">Заказов: '+res['task_number'][0]+'</div>';
        name_field.href = 'profile?profile_id=' + res['login'];
        const text_field = document.createElement('div');
        text_field.innerHTML = res['text'];
        const deadline_field = document.createElement('div');
        deadline_field.innerHTML = 'Сделать до: '+res['deadline'];
        const reward_field = document.createElement('div');
        reward_field.innerHTML = 'Цена вопроса: '+res['reward']+"руб.";
        const method_field = document.createElement('div');
        method_field.innerHTML = 'Метод оплаты: '+res['payment_method'];

        const tags_field = document.createElement('div');
        let tags = res['tags'].split(', ');
        tags_field.className = 'tags';
        
        for (let i = 0; i < tags.length; i++){
            tags_field.innerHTML+='<div class="tag">'+tags[i]+'</div>';
        }

        info_container.appendChild(text_field);
        info_container.appendChild(tags_field);
        info_container.appendChild(reward_field);
        info_container.appendChild(method_field);
        info_container.appendChild(deadline_field);

        if(localStorage.getItem('role') === 'isp' && res['login'] !== '<?php echo $_SESSION['user']; ?>'){
            const feedback_button = document.createElement('a');
            feedback_button.innerHTML = "Откликнуться";
            feedback_button.href = "new_feedback?task_id="+'<?php echo $_GET['task_id'] ?>';
            feedback_button.className = 'feedback_button';

            buttons_container.appendChild(feedback_button);
        }
        else if (res['login'] === '<?php echo $_SESSION['user']; ?>'){
            const feedback_button = document.createElement('a');
            feedback_button.innerHTML = "Отредактировать";
            feedback_button.href = "new_task?action=edit&task_id="+'<?php echo $_GET['task_id'] ?>';
            feedback_button.className = 'feedback_button';

            buttons_container.appendChild(feedback_button);
        }

        task_container.appendChild(info_container);
        task_container.appendChild(buttons_container);

        feedbacks = res['feedbacks'];

        const feedbacks_container = document.getElementsByClassName('feedbacks')[0];

        feedbacks.forEach(feedback => {
            const feedback_container = document.createElement('div');
            feedback_container.className = 'feedback_container';
            const finfo_field = document.createElement('div');
            const fbuttons_field = document.createElement('div');

            const fname_field = document.createElement('a');
            fname_field.href = 'profile?profile_id=' + feedback['login'];
            fname_field.innerHTML = '<img src="/static/images.jpg">' + feedback['surname'] + " " + feedback['name'][0] + ". " + (feedback['patronymic'] ? feedback['patronymic'][0]+'. ' : '') + (feedback['verified'] ? '<i class="verified-user">+</i>' : '');
            fname_field.className = 'name_container';
            const ftext_field = document.createElement('div');
            ftext_field.innerHTML = feedback['text'];
            const fdeadline_field = document.createElement('div');
            fdeadline_field.innerHTML = 'Сделает до: '+feedback['deadline'];
            const freward_field = document.createElement('div');
            freward_field.innerHTML = 'Назначил цену: '+feedback['reward']+"руб.";
            const fmethod_field = document.createElement('div');
            fmethod_field.innerHTML = 'Метод оплаты: '+feedback['payment_method'];

            finfo_field.appendChild(fname_field);
            finfo_field.appendChild(ftext_field);
            finfo_field.appendChild(freward_field);
            finfo_field.appendChild(fmethod_field);
            finfo_field.appendChild(fdeadline_field);

            if(localStorage.getItem('role') === 'zak' && feedback['login'] !== '<?php echo isset($_SESSION['user']) ? $_SESSION['user'] : ''; ?>'){
                const feedback_button = document.createElement('a');
                feedback_button.innerHTML = "Принять";
                feedback_button.href = "php/process_tasks.php?action=makeOfficial&task_id="+'<?php echo $_GET['task_id'] ?>';
                feedback_button.className = 'feedback_button';

                fbuttons_field.appendChild(feedback_button);
            }
            else if (feedback['login'] === '<?php echo isset($_SESSION['user']) ? $_SESSION['user'] : ''; ?>'){
                const feedback_button = document.createElement('a');
                feedback_button.innerHTML = "Отредактировать";
                feedback_button.href = "new_feedback?action=edit&task_id="+feedback['id'];
                feedback_button.className = 'feedback_button';

                fbuttons_field.appendChild(feedback_button);
            }

            feedback_container.appendChild(finfo_field);
            feedback_container.appendChild(fbuttons_field);

            feedbacks_container.appendChild(feedback_container);
        });
        
        loading.classList.add('hidden');
    })
</script>
<div class="loading" id="loading">Загрузка...</div>
<a class="pr name_container">
</a>
<div class="task_container">
    
</div>
<div class="feedbacks">
</div>