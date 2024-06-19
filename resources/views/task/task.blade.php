<x-app-layout>
    <div class="task_container">
        <div>{{ $task->task_data->text }}</div>
        <div>
            @foreach ($task->task_data->tags as $tag)
                <div>{{ $tag }}</div>
            @endforeach
        </div>
        <div>{{ $task->task_data->reward }}</div>
    </div>
</x-app-layout>