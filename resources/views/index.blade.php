<x-app-layout>
    <div class="iblock1" style="white-space: pre-wrap; text-align: center;">
Крутой Фриланс – площадка для
быстрого поиска работы и
работников в России. Круто!
    </div>
    <div class="iblock2">
        <button class="next-button iblock-button">></button>
        <button class="prev-button iblock-button"><</button>
        <div class="shown sh">
            @include('components.image-buyer')
            <div>Кирилл Карпачинко</div>
            <div>"Круто!"</div>
        </div>
        <div class="sh">
            @include('components.image-buyer')
            <div>Гавриил Жестонович</div>
            <div>"Круто!"</div>
        </div>
        <div class="sh">
            @include('components.image-buyer')
            <div>Данил Каракатицев</div>
            <div>"Круто!"</div>
        </div>
    </div>
    <div class="iblock3">
        В общем, заказывайте и откликайтесь
    </div>

    <script>
        let showns = document.querySelectorAll('.sh');
        let shown = 0;
        let button_next = document.querySelector('.next-button');
        let button_prev = document.querySelector('.prev-button');
        function updateCurrent(){
            showns.forEach(sh => {
                sh.classList.add('hide');
            });
            showns[shown].classList.remove('hide');
        }
        updateCurrent();
        button_next.addEventListener('click', () => {
            if(shown+1 != 3) shown++;
            else shown = 0;
        })
        button_prev.addEventListener('click', () => {
            if(shown-1 != -1) shown--;
            else shown = 2;
        })
    </script>
</x-app-layout>