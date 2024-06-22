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
            <div class="name_container"></div>    
        @endforeach
    </div>
</x-app-layout>