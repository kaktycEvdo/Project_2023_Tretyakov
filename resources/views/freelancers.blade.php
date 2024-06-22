<x-app-layout>
    <div class="freelancers_container">
        @foreach ($frs as $key => $fr)
            <a class="freelancer_container" href={{ route('profile.edit', ['id' => $fr['id']]) }}>
                <div class='profile_name_img'>@include('components.image-freelancer'){{ $fr['surname'] }} {{ Str::limit($fr['name'], 1, '') }}. {{ Str::limit($fr['patronymic'], 1, '') }}.</div>
                <div>
                    <div>О себе:</div>
                    <textarea disabled>{{ Str::limit($fr['about'], 500, '...')  }}</textarea>
                    <div>Характеристики:</div>
                    @if (sizeof($fr['chars']) < 1)
                    @foreach ($fr['chars'] as $char)
                    <div>{{ $char }}</div>
                    @endforeach    
                    @else
                        <div>Нету</div>
                    @endif
                </div>
            </a>    
        @endforeach
    </div>
</x-app-layout>