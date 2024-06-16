<x-app-layout>
    <form method="POST" action="{{ route('register') }}">
        <h2>Регистрация</h2>
        <h4>* - необходимые поля</h4>
        <div class="form_fields">
            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Почта*')" />
                <x-text-input id="email" type="email" name="email" required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Login -->
            <div>
                <x-input-label for="login" :value="__('Логин*')" />
                <x-text-input id="login" type="text" name="login" required />
                <x-input-error :messages="$errors->get('login')" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Пароль*')" />
                <x-text-input id="password" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Password repeat -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Повторите пароль*')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>

            <!-- Checks -->
            <div class="flex flex-col">
                <label for="confidentiality">
                    <input id="confidentiality" type="checkbox" required>
                    <span>Соглашаюсь с условиями конфиденциальности*</span>
                </label>
                <label for="ofert">
                    <input id="ofert" type="checkbox" required>
                    <span>Соглашаюсь с публичной офертой*</span>
                </label>
            </div>

            <!-- Name -->
            <div class="hidden">
                <x-input-label for="name" :value="__('Имя')" class="hidden" />
                <x-text-input id="name" type="text" name="name" max="52" class="hidden" required />
                <x-input-error class="hidden" :messages="$errors->get('name')" />
            </div>

            <!-- Surname -->
            <div class="hidden">
                <x-input-label for="surname" :value="__('Фамилия')" class="hidden" />
                <x-text-input id="surname" type="text" name="surname" max="52" class="hidden" required />
                <x-input-error class="hidden" :messages="$errors->get('surname')" />
            </div>

            <!-- Patronymic -->
            <div class="hidden">
                <x-input-label for="patronymic" :value="__('Отчество')" class="hidden" />
                <x-text-input id="patronymic" type="text" name="patronymic" maxlenght="52" class="hidden" />
                <x-input-error class="hidden" :messages="$errors->get('patronymic')" />
            </div>

            <!-- Phone -->
            <div class="hidden">
                <x-input-label for="phoneNumber" :value="__('Телефон')" class="hidden" />
                <x-text-input id="phoneNumber" :value="__('+7')" maxlength="16" type="text" name="phone" class="hidden" required />
                <x-input-error class="hidden" :messages="$errors->get('phone')" />
            </div>
        </div>
        <div class="form_bottom">    
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Запомнить меня</span>
            </label>
            <a onclick="next()" class="cursor-pointer">Далее</a>
            <a onclick="back()" class="cursor-pointer hidden">Назад</a>
            <input type="submit" value="Отправить" class="hidden"/>
        </div>
        <div id="error" class="hidden"></div>
    </form>
</x-app-layout>
<script>
    let error = document.querySelector("div#error");

    function showError(msg){
        error.innerHTML = "Ошибка: "+msg;
        error.classList.remove("hidden");
    }
    function hideError(){
        error.innerHTML = "";
        error.classList.add("hidden");
    }

    let hiddens = document.querySelectorAll(':not(#error).hidden');
    let others = document.querySelectorAll('.form_fields :not(.hidden), .form_bottom :not(.hidden)');

    function next(){
        if(error.innerHTML == ''){
            hiddens.forEach(hidden => {
                hidden.classList.remove('hidden');
            });
            others.forEach(other => {
                other.classList.add('hidden');
            });
        }
    }

    function back(){
        hiddens.forEach(hidden => {
            hidden.classList.add('hidden');
        });
        others.forEach(other => {
            other.classList.remove('hidden');
        });
    }

    const isNumericInput = (event) => {
        const key = event.keyCode;
        return ((key >= 48 && key <= 57) || // Allow number line
            (key >= 96 && key <= 105) // Allow number pad
        );
    };

    const isModifierKey = (event) => {
        const key = event.keyCode;
        return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
            (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
            (key > 36 && key < 41) || // Allow left, up, right, down
            (
                // Allow Ctrl/Command + A,C,V,X,Z
                (event.ctrlKey === true || event.metaKey === true) &&
                (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
            )
    };

    const enforceFormat = (event) => {
        // Input must be of a valid number format or a modifier key, and not longer than ten digits
        if(!isNumericInput(event) && !isModifierKey(event)){
            event.preventDefault();
        }
    };

    const formatToPhone = (event) => {
        if(isModifierKey(event)) {return;}

        const input = event.target.value.replace(/\D/g,'').substring(0,13); // First ten digits of input only
        const middle = input.substring(1,4);
        const mlast = input.substring(4,7);
        const last = input.substring(7,11);
        console.log(last);

        if(input.length > 7){event.target.value = `+7(${middle})${mlast}-${last}`;}
        else if(input.length > 4){event.target.value = `+7(${middle})${mlast}`;}
        else if(input.length > 0){event.target.value = `+7(${middle}`;}
    };

    const inputElement = document.getElementById('phoneNumber');
    inputElement.addEventListener('keydown',enforceFormat);
    inputElement.addEventListener('keyup',formatToPhone);

    document.addEventListener("DOMContentLoaded", function () {
        let passwordR = document.querySelector("#passwordR");
        if(passwordR){
            for (let ev of ['input', 'blur', 'focus']) {
                passwordR.addEventListener(ev, (e) => {
                    let el = e.target;
                    console.log(el.value !== document.querySelector('#password').value);
                    if(el.value !== document.querySelector('#password').value) showError("Пароли не совпадают.");
                    else hideError();
                });
            }
        }
    });
</script>