<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h2>Авторизация</h2>
        <div class="form_fields">
            <!-- Login -->
            <div>
                <x-input-label for="login" :value="__('Логин')" />
                <x-text-input id="login" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('login')" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Пароль')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
        </div>
        <div class="form_bottom">
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Запомнить меня</span>
            </label>
            <a href="{{ route('register') }}">Регистрация</a>
            <input type="submit" value="Отправить"/>
        </div>
    </form>
</x-guest-layout>
