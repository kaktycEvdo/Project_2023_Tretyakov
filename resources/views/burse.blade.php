<x-app-layout>
    <div class="tasks_container">
        @foreach ($tasks as $task)
            <a class="task_container" {{ route('task', ['id' => $task->task_data]) }}>
                <div>{{ Str::limit($task->task_data->text, 500, '...') }}</div>
                <div>
                    @foreach ($task->task_data->tags as $tag)
                        <div>{{ $tag }}</div>
                    @endforeach
                </div>
                <div>{{ $task->task_data->reward }}</div>
            </a>    
        @endforeach
    </div>
</x-app-layout>