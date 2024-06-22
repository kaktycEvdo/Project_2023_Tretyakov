<x-app-layout>
    <div class="tasks_container">
        <div class='first_element'><a href={{ route('task.create') }}>Добавить свой заказ</a></div>
        @foreach ($tasks as $task)
            <a class="task_container" href={{ route('task.show', ['id' => $task->id]) }}>
                <div>{{ Str::limit(App\Models\TaskData::where('id', $task->task_data)->first()->text, 500, '...') }}</div>
                <div>
                    @php
                        $tags = explode(', ', $task->tags);
                        foreach ($tags as $tag) {
                            echo '<div>'.$tag.'</div>';
                        }
                    @endphp
                </div>
                <div>{{ App\Models\TaskData::where('id', $task->task_data)->first()->reward }}руб.</div>
            </a>    
        @endforeach
    </div>
</x-app-layout>