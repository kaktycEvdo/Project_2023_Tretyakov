<x-app-layout>
    <div id="chat_container">
        <div id="history">
            @if ($recepient)
                <a class="selected_recepient recepient" href={{ route('chat', ['id'=>$recepient['id']]) }}>
                    @include('components.image-buyer')
                    {{ $recepient['user']->surname }} {{ Str::limit($recepient['user']->name, 1, '') }}. {{ Str::limit($recepient['user']->patronymic, 1, '') }}.
                </a>
            @endif

            @if ($dialogues)
                @foreach ($dialogues as $dialogue)
                    @if ($recepient && $dialogue['id'] == $recepient['id'])

                    @else
                    <a class="recepient" href={{ route('chat', ['id'=>$dialogue['id']]) }}>
                        @include('components.image-buyer')
                            {{ $dialogue['data']->surname }} {{ Str::limit($dialogue['data']->name, 1, '') }}. {{ Str::limit($dialogue['data']->patronymic, 1, '') }}.
                    </a>
                    @endif
                @endforeach
            @endif
        </div>
        <div id="dialogue">
            <div class="messages">
                @if ($messages)
                @foreach ($messages as $message)
                    @if ($message->author == $user)
                        <div class="yours">{{ $message->text }}</div>
                    @else
                        <div class="others">{{ $message->text }}</div>
                    @endif
                @endforeach    
                @endif
            </div>
            @if ($recepient)
            <form method="POST" class="no-form inputs">
                <input name="text" id="text" type="text" value="" maxlength="2000" />
                <label for="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></label>
                <input type="submit" id="submit" value="" hidden>
                <input type="hidden" value={{ $recepient['id'] }} />
                <script>
                    let input = document.getElementById('text');
                    let button = document.getElementById('submit');
                    for (let ev of ['input', 'blur', 'focus']) {
                        input.addEventListener(ev, (e) => {
                            let el = e.target;
                            if(el.value !== '') button.removeAttribute('disabled');
                            else button.setAttribute('disabled', true);
                        });
                    }
                    button.addEventListener('click', (e) => {
                        e.preventDefault();

                        let data = {
                            "text" : input.value,
                            "recepient" : '{{ $recepient["id"] }}',
                            'author': '{{ Auth::user()->id }}'
                        };
                        data = 'text='+input.value+'&recepient={{ $recepient["id"] }}&author={{ Auth::user()->id }}';

                        let href = '{{route('chat.create', ['recepient' => $recepient['id']])}}'
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", href, true);
                        xhr.onreadystatechange = () => {
                            // Call a function when the state changes.
                            if (xhr.readyState === XMLHttpRequest.UNSENT){
                                console.log('что');
                            }
                            else if (xhr.readyState === 4){
                                window.location.reload();
                            }
                        };

                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send(data);
                        
                    });
                </script>
            </form>
            @endif
        </div>
    </div>
</x-app-layout>