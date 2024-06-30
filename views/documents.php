<script>
    fetch('../php/process_cards.php?action=getAll').
    then(response => {
        let res = response.json();
        if(response.headers.get('content-type') !== 'application/json; charset=utf-8'){
            popup('error', 'Error: not json returned');
        }
        
        return res;
    }, error => {
        console.log(error);
    }).then(res => {
        const cards_container = document.getElementsByClassName('cards_list')[0];
        const loading = document.getElementById('loading');

        for(i = 0; i < res.length; i++){
            const card_container =document.createElement('a');
            card_container.className = 'card';
            card_container.href = 'php/process_cards.php?action=delete&id='+res[i]['number'];
            const number_field = document.createElement('div');
            number_field.innerHTML = '**************'+res[i]['number'][res[i]['number'].length-1]+res[i]['number'][res[i]['number'].length-2];
            const expiry_field = document.createElement('div');
            expiry_field.innerHTML = res[i]['expiry'];
            const scc_field = document.createElement('div');
            scc_field.innerHTML = '***';

            card_container.appendChild(number_field);
            card_container.appendChild(expiry_field);
            card_container.appendChild(scc_field);
            cards_container.appendChild(card_container);
        }
        if(res.length === 0){
            cards_container.innerHTML = "<div class='no_elements'>Нет карт(</div>";
        }
        loading.classList.add('hidden');
    })
</script>
<div class="loading" id="loading">Загрузка...</div>
<div class="cards_list">
    
</div>
<form method="POST" action="php/process_cards.php?action=add" class="new_card">
    <h3>Добавить карту:</h3>
    <div class="form_fields">
        <label for="">Номер карты:</label>
        <input name="number" type="text" minlength="16" maxlength="16" required>
        <label for="">Годность:</label>
        <input name="expiry" type="date" required>
        <label for="">SCC:</label>
        <input name="scc" type="text" minlength="3" maxlength="3" required>
    </div>
    <div class="form_bottom">
        <input type="submit" value="Прикрепить">
    </div>
</form>