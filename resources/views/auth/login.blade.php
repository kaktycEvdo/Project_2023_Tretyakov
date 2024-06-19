<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Авторизация</h2>
        <div class="form_fields">
            <!-- Login -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>
        <div class="form_bottom">
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Запомнить меня</span>
            </label>
            <input type="submit" value="Отправить"/>
        </div>
    </form>
</x-app-layout>
