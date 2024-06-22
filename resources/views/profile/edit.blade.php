<x-app-layout>
    <div class="profile_container">
        <div class="profile_brief">
            <div class="profile_name_img">
                <div class="lk_fr hidden">
                    @include('components.image-freelancer')
                </div>
                <div class="lk_pr">
                    @include('components.image-buyer')
                </div>
                {{ $user['surname'] }} {{ Str::limit($user['name'], 1, '') }}. {{ Str::limit($user['patronymic'], 1, '') }}.
            </div>
            <div class="profile_brief_buttons">
                @if($user['id'] != Auth::user()->id)
                <a href={{ route('chat', ['id' => $user['id']]) }}>Написать</a>
                <a onclick='showFreelancer(false);'>Исполнитель</a>
                <a onclick='showPurchaser(false);'>Заказчик</a>
                @else
                <a onclick='showFreelancer(true);'>Исполнитель</a>
                <a onclick='showPurchaser(true);'>Заказчик</a>
                @endif
            </div>
        </div>
        <div>
            <form class="no-form" method="POST" action={{ route('profile.update') }}>
                <div class="profile_about">
                    <div>О себе:</div>
                    <textarea name="fr_about" class="lk_fr hidden" disabled='true'>{{ $user['fr-about'] }}</textarea>
                    <textarea name="pr_about" class="lk_pr" disabled='true'>{{ $user['pr-about'] }}</textarea>
                </div>
                <div class="profile_charas lk_fr hidden">
                    <div>Характеристики:</div>
                        @if (sizeof($user['fr-chars']) < 1)
                        @foreach ($user['fr-chars'] as $char)
                        <div>{{ $char }}</div>
                        @endforeach
                        @else
                            <div>Нету</div>
                        @endif
                        <input class="form-input hidden" name="fr_characteristics" type="text"
                        value='@foreach ($user['fr-chars'] as $char)
                        {{ $char }}
                        @endforeach' />
                </div>
                <div class="profile_charas lk_pr">
                    <div>Характеристики:</div>
                        @if (sizeof($user['pr-chars']) < 1)
                        @foreach ($user['pr-chars'] as $char)
                        <div>{{ $char }}</div>
                        @endforeach
                        @else
                            <div>Нету</div>
                        @endif
                        <input class="form-input hidden" name="pr_characteristics" type="text"
                        value='@foreach ($user['pr-chars'] as $char)
                        {{ $char }}
                        @endforeach' />
                </div>
                <div class="form_bottom">
                    @if($user['id'] == Auth::user()->id)
                    <input type="submit" class="hidden" />
                    <a onclick="next()" class="cursor-pointer">Изменить</a>
                    <a onclick="back()" class="cursor-pointer hidden">Отмена</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script>
        function next(){
            let hiddens = document.querySelectorAll('.profile_about > .hidden, .profile_charas.hidden, .form_bottom .hidden');
            let disabled = document.querySelectorAll('[disabled]');
            let others = document.querySelectorAll('.profile_about > :not(.hidden), .profile_charas:not(.hidden), .form_bottom :not(.hidden)');
            hiddens.forEach(hidden => {
                hidden.classList.remove('hidden');
            });
            others.forEach(other => {
                other.classList.add('hidden');
            });
            disabled.forEach(dis => {
                dis.removeAttribute('disabled');
            });
        }

        function back(){
            let others = document.querySelectorAll('.profile_about > .hidden, .profile_charas.hidden, .form_bottom .hidden');
            let disabled = document.querySelectorAll('textarea:not([disabled])');
            let hiddens = document.querySelectorAll('.profile_about > :not(.hidden), .profile_charas:not(.hidden), .form_bottom :not(.hidden)');
            hiddens.forEach(hidden => {
                hidden.classList.add('hidden');
            });
            others.forEach(other => {
                other.classList.remove('hidden');
            });
            disabled.forEach(dis => {
                dis.setAttribute('disabled', true);
            });
        }
    </script>
</x-app-layout>
