<x-app-layout>
    <div class="freelancers_container">
        @foreach ($frs as $fr)
            <a class="freelancer_container" {{ route('profile.view', ['id' => $fr->id]) }}>
                <div>{{ $fr->surname }} {{ Str::limit($fr->name, 1) }}. {{ Str::limit($fr->patronymic, 1) }}.</div>
                <div>
                    @foreach ($fr->task_data->tags as $tag)
                        <div>{{ $tag }}</div>
                    @endforeach
                </div>
                <div>{{ $fr->task_data->reward }}</div>
            </a>    
        @endforeach
    </div>
</x-app-layout>