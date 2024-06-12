<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h2>Регистрация</h2>
        <div class="form_fields">
            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Почта')" />
                <x-text-input id="email" type="email" name="email" required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Login -->
            <div>
                <x-input-label for="login" :value="__('Логин')" />
                <x-text-input id="login" type="text" name="login" required />
                <x-input-error :messages="$errors->get('login')" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Пароль')" />
                <x-text-input id="password" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Checks -->
            <div class="flex flex-col">
                <label for="confidentiality">
                    <input id="confidentiality" type="checkbox" required>
                    <span>Соглашаюсь с условиями конфиденциальности</span>
                </label>
                <label for="ofert">
                    <input id="ofert" type="checkbox" required>
                    <span>Соглашаюсь с публичной офертой</span>
                </label>
            </div>
        </div>
        <div class="form_bottom">    
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Запомнить меня</span>
            </label>
            <a href="{{ route('login') }}">Авторизация</a>
            <input type="submit" value="Отправить" class="hidden"/>
            <button onclick="next()">Далее</button>
            <button onclick="back()" class="hidden">Назад</button>
        </div>
    </form>
</x-guest-layout>
<script>
    let hiddens = document.getElementsByClassName('hidden');
    let others = document.querySelectorAll(':not(.hidden).form_fields, .form_bottom :not(.hidden)');

    function next(){
        hiddens.forEach(hidden => {
            hidden.classList.remove('hidden');
        });
        others.forEach(other => {
            other.classList.add('hidden');
        });
    }

    function back(){
        hiddens.forEach(hidden => {
            hidden.classList.add('hidden');
        });
        others.forEach(other => {
            other.classList.remove('hidden');
        });
    }
</script>