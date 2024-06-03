<script>
    let task_texts = '';
    let task_owners = '';
    function searchContent(){
        
    }
    fetch('php/process_user.php?action=getAllByRole&role=freelancer').
    then(response => {
        let res = response.json();
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            popup('error', 'Error: not json returned');
        }
        
        return res;
    }, error => {
        console.log(error);
    }).then(res => {
        const freelancers_container = document.getElementsByClassName('freelancers_container')[0];
        const loading = document.getElementById('loading');

        for(i = 0; i < res.length; i++){
            const freelancer_container =document.createElement('a');
            freelancer_container.className = 'freelancer_container';
            freelancer_container.href = 'profile?profile_id='+res[i]['login'];
            const name_field = document.createElement('div');
            name_field.innerHTML = "<div class='profile_name_img'><img src='static/e93161a711d78c374f9a863188be1edc.jpg'>"+res[i]['surname'] + " " + res[i]['name'][0] + ". " + res[i]['patronymic'][0] + "." + (res[i]['verified'] ? '<i class="verified-user">+</i>' : '')+"</div>";
            const details_field =document.createElement('div');
            const about_field = document.createElement('div');
            about_field.innerHTML = "<div>О себе:</div><textarea disabled>"+(res[i]['freelancer_about'] ? res[i]['freelancer_about'] : 'Нету')+"</textarea>";
            const chars_field = document.createElement('div');
            chars_field.innerHTML = "<div>Характеристики:</div><div class='freelancer_charas'>";
            if(res[i]['freelancer_chars']){
                let chars = res[i]['freelancer_chars'].split(", ");

                let str = '';

                for(i = 0; i < chars.length; i++){
                    str += "<div>"+chars[i]+"</div>";
                }
                chars_field.innerHTML = chars_field.innerHTML + str + "</div>";
            }
            else{
                chars_field.innerHTML = "Нету</div>"
            }
            
            

            details_field.appendChild(about_field);
            details_field.appendChild(chars_field);
            freelancer_container.appendChild(name_field);
            freelancer_container.appendChild(details_field)
            freelancers_container.appendChild(freelancer_container);
        }
        if(res.length === 0){
            freelancers_container.innerHTML = "<div class='first_element'>Нет ни одного фрилансера(</div>";
        }
        loading.classList.add('hidden');
    })
</script>
<div class="loading" id="loading">Загрузка...</div>
<div class="freelancers_container">
</div>