<x-app-layout>
    <a class="name_container" href={{ route('profile.edit', ['id' => $id]) }}>
        @include('components.image-buyer')
        {{ $purchaser->surname }} {{ Str::limit($purchaser->name, 1, '') }}. {{ Str::limit($purchaser->patronymic, 1, '') }}.
    </a>
    <div class="task_container">
        <div>{{ $task_data->text }}</div>
        <div>
            @foreach ($tags as $tag)
                <div>{{ $tag }}</div>
            @endforeach
        </div>
        <div>{{ $task_data->reward }}руб.</div>
        @auth
        @if (Auth::user()->id != $id)
        <a href={{ route('new_feedback') }}>Откликнуться</a>
        @endif    
        @endauth
    </div>
    <div class="feedbacks_container">
        @foreach ($feedbacks as $feedback)
            <a class="name_container" href={{ route('profile.edit', ['id' => $id]) }}>
                @include('components.image-buyer')
                {{ $feedback['user']->surname }} {{ Str::limit($feedback['user']->name, 1, '') }}. {{ Str::limit($feedback['user']->patronymic, 1, '') }}.
            </a>
            <div class="feedback_container">
                <div>
                    {{ $feedback['fd']->text }}
                </div>
                <div>
                    Просит цену: {{ $feedback['fd']->reward }}руб.
                </div>
                <div>
                    Выполнит до: {{ $feedback['fd']->deadline }}
                </div>
                <div>Способ оплаты: 
                    @switch($feedback['fd']->payment_method)
                        @case(0)
                            Предоплата полностью
                            @break
                        @case(1)
                            Частями во время выполнения
                            @break
                        @case(2)
                            Оплата после получения результата
                            @break
                    @endswitch
                </div>
                @if (Auth::user()->id == $id)
                <a href="{{ route('feedback.accept', ['id' => $feedback['id']->task, '']) }}">Назначить исполнителем</a>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>