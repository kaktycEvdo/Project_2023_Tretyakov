<header class="big-header">
    <x-auth-session-status :status="session('status')" />
    <a class="hlogo_container" href="{{ route('index') }}">
        КФ Крутой Фриланс
    </a>
    <nav>
        <a href="{{ route('index') }}">
            Главная
        </a>
        @if (Auth::check())
        <a href="{{ route('freelancers') }}">
            Фрилансеры
        </a>
        <a href="{{ route('burse') }}">
            Биржа
        </a>
        <a href="{{ route('chat') }}">
            Чат
        </a>
        @else
        <a href="{{ route('burse') }}">
            Биржа
        </a>
        @endif
    </nav>
    <!-- Settings Dropdown -->
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="top" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 focus:outline-none transition ease-in-out duration-150">
                    @if (Auth::check())
                    <div class="lk_logo lk_fr hidden">
                        @include('components.image-freelancer')
                    </div>
                    <div class="lk_logo lk_pr">
                        @include('components.image-buyer')
                    </div>
                    <script>
                        function showPurchaser(changeProfile){
                            let prs = document.querySelectorAll(':not(.lk_logo).lk_pr');
                            let frs = document.querySelectorAll(':not(.lk_logo).lk_fr');
                            let sprs = document.querySelectorAll('.lk_logo.lk_pr');
                            let sfrs = document.querySelectorAll('.lk_logo.lk_fr');
                            for (let i = 0; i < prs.length; i++){
                                prs[i].classList.remove('hidden');
                                frs[i].classList.add('hidden');
                            }
                            if(changeProfile) {
                                for (let i = 0; i < sprs.length; i++){
                                    sprs[i].classList.remove('hidden');
                                    sfrs[i].classList.add('hidden');
                                }
                                localStorage.role = 'buy';
                            }
                        }
                        function showFreelancer(changeProfile){
                            let prs = document.querySelectorAll(':not(.lk_logo).lk_pr');
                            let frs = document.querySelectorAll(':not(.lk_logo).lk_fr');
                            let sprs = document.querySelectorAll('.lk_logo.lk_pr');
                            let sfrs = document.querySelectorAll('.lk_logo.lk_fr');
                            for (let i = 0; i < prs.length; i++){
                                prs[i].classList.add('hidden');
                                frs[i].classList.remove('hidden');
                            }
                            if(changeProfile) {
                                for (let i = 0; i < sprs.length; i++){
                                    sprs[i].classList.add('hidden');
                                    sfrs[i].classList.remove('hidden');
                                }
                                localStorage.role = 'isp';
                            }
                        }
                        if (localStorage.role == 'isp'){
                            showFreelancer();
                        };
                    </script>
                    @else
                    <div class="lk_logo">
                        @include('components.image-what')
                    </div>
                    @endif
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                @if (Auth::check())
                <x-dropdown-link class="w-full inline-block" :href="route('profile.edit')">
                    {{ __('Профиль') }}
                </x-dropdown-link>
                
                <form method="POST" class="no-form" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link class="w-full inline-block" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Выйти') }}
                    </x-dropdown-link>
                </form>
                @if ( Auth::user()->is_admin )
                <x-dropdown-link class="w-full inline-block" :href="route('dashboard')">
                    {{ __('Админ-панель') }}
                </x-dropdown-link>
                @endif
                @else
                <x-dropdown-link class="w-full inline-block" :href="route('login')">
                    {{ __('Авторизация') }}
                </x-dropdown-link>

                <x-dropdown-link class="w-full inline-block" :href="route('register')">
                    {{ __('Регистрация') }}
                </x-dropdown-link>
                @endif
            </x-slot>
        </x-dropdown>
    </div>
</header>
<header class="small-header">
    <x-auth-session-status :status="session('status')" />
    <a class="hlogo_container" href="{{ route('index') }}">
        КФ
    </a>
    <!-- Settings Dropdown -->
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="top" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 focus:outline-none transition ease-in-out duration-150">
                    @if (Auth::check())
                    <div class="lk_logo lk_fr hidden">
                        @include('components.image-freelancer')
                    </div>
                    <div class="lk_logo lk_pr">
                        @include('components.image-buyer')
                    </div>
                    <script>
                        function showPurchaser(changeProfile){
                            let prs = document.querySelectorAll(':not(.lk_logo).lk_pr');
                            let frs = document.querySelectorAll(':not(.lk_logo).lk_fr');
                            let sprs = document.querySelectorAll('.lk_logo.lk_pr');
                            let sfrs = document.querySelectorAll('.lk_logo.lk_fr');
                            for (let i = 0; i < prs.length; i++){
                                prs[i].classList.remove('hidden');
                                frs[i].classList.add('hidden');
                            }
                            if(changeProfile) {
                                for (let i = 0; i < sprs.length; i++){
                                    sprs[i].classList.remove('hidden');
                                    sfrs[i].classList.add('hidden');
                                }
                                localStorage.role = 'buy';
                            }
                        }
                        function showFreelancer(changeProfile){
                            let prs = document.querySelectorAll(':not(.lk_logo).lk_pr');
                            let frs = document.querySelectorAll(':not(.lk_logo).lk_fr');
                            let sprs = document.querySelectorAll('.lk_logo.lk_pr');
                            let sfrs = document.querySelectorAll('.lk_logo.lk_fr');
                            for (let i = 0; i < prs.length; i++){
                                prs[i].classList.add('hidden');
                                frs[i].classList.remove('hidden');
                            }
                            if(changeProfile) {
                                for (let i = 0; i < sprs.length; i++){
                                    sprs[i].classList.add('hidden');
                                    sfrs[i].classList.remove('hidden');
                                }
                                localStorage.role = 'isp';
                            }
                        }
                        if (localStorage.role == 'isp'){
                            showFreelancer();
                        };
                    </script>
                    @else
                    <div class="lk_logo">
                        @include('components.image-what')
                    </div>
                    @endif
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link href="{{ route('index') }}">
                    Главная
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('burse') }}">
                    Биржа
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('freelancers') }}">
                    Фрилансеры
                </x-dropdown-link>
                @if (Auth::check())
                <x-dropdown-link href="{{ route('chat') }}">
                    Чат
                </x-dropdown-link>
                <x-dropdown-link class="w-full inline-block" :href="route('profile.edit')">
                    {{ __('Профиль') }}
                </x-dropdown-link>
                
                <form method="POST" class="no-form" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link class="w-full inline-block" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Выйти') }}
                    </x-dropdown-link>
                </form>
                @if ( Auth::user()->is_admin )
                <x-dropdown-link class="w-full inline-block" :href="route('dashboard')">
                    {{ __('Админ-панель') }}
                </x-dropdown-link>
                @endif
                @else
                <x-dropdown-link class="w-full inline-block" :href="route('login')">
                    {{ __('Авторизация') }}
                </x-dropdown-link>

                <x-dropdown-link class="w-full inline-block" :href="route('register')">
                    {{ __('Регистрация') }}
                </x-dropdown-link>
                @endif
            </x-slot>
        </x-dropdown>
    </div>
</header>