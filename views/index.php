<div class="iblock1" style="white-space: pre-wrap; text-align: center;">Крутой Фриланс – площадка для
быстрого поиска работы и
работников в России. Круто!
</div>
<div class="iblock2">
    <div class="ch">
        <img src="static/images.jpg"/>
        <div>Кирилл Карпачинко</div>
        <div>"Круто!"</div>
    </div>
    <div class="ch">
        <img src="static/images.jpg"/>
        <div>Гавриил Жестонович</div>
        <div>"Круто!"</div>
    </div>
    <div class="ch">
        <img src="static/images.jpg"/>
        <div>Данил Каракатицев</div>
        <div>"Круто!"</div>
    </div>
</div>
<div class="iblock3">
    В общем, заказывайте и откликайтесь
</div>
<script>
    var blocks = [document.querySelector('.iblock2 > div:nth-child(1)'), document.querySelector('.iblock2 > div:nth-child(2)'), document.querySelector('.iblock2 > div:nth-child(3)')];
    
    var selected = 1;
    function updateChosens(){
        for(let i = 0; i < blocks.length; i++){
            blocks[i].classList.remove('chosen')
            if (i+1 === selected) blocks[i].classList.add('chosen')
        }
    }
    updateChosens();
</script>