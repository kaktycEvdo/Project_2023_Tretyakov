<x-app-layout>
    <div id="chat_container">
        <div id="history">

        </div>
        <div id="dialogue">
            <div class="messages">
                @foreach ($messages as $message)
                    @if ($message->author == $user)
                        <div class="yours">{{ $message->text }}</div>
                    @else
                        <div class="others">{{ $message->text }}</div>
                    @endif
                @endforeach
            </div>
            <div class="inputs"></div>
        </div>
    </div>
</x-app-layout>