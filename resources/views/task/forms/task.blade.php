<x-app-layout>
    <form method="POST" action="{{ route('task.create') }}" >
        <h2>Заказ оформляет: {{ Auth::user()->login }}</h2>
        <div class="form_fields">
            <!-- text -->
            <div>
                <x-input-label for="text" :value="__('Текст заказа (200-2000 символов)')" />
                <textarea id="text" name="text" maxlength="2000" minlength="200" required autofocus style="resize: vertical; min-height: 30vh; max-height: 70vh; font-size: 1.2em;"></textarea>
                <x-input-error :messages="$errors->get('text')" />
            </div>
    
            <!-- reward -->
            <div>
                <x-input-label for="reward" :value="__('Цена заказа (в рублях)')" />
                <x-text-input id="reward" type="number" name="reward" placeholder="0" min="0" max="1000000" required />
                <x-input-error :messages="$errors->get('reward')" />
            </div>
    
            <!-- deadline -->
            <div>
                <x-input-label for="deadline" :value="__('Дедлайн')" />
                <x-text-input id="deadline" type="datetime-local" name="deadline" required />
                <x-input-error :messages="$errors->get('deadline')" />
            </div>
    
            <!-- tags -->
            <div>
                <x-input-label for="tags" :value="__('Теги заказа (через запятую и пробел)')" />
                <x-text-input id="tags" type="text" name="tags" />
                <x-input-error :messages="$errors->get('tags')" />
            </div>
    
            <!-- payment method -->
            <div>
                <x-input-label for="payment_method" :value="__('Способ оплаты')" />
                <select name="payment_method" class="w-full" id="payment_method">
                    <option value="0">Предоплата полностью</option>
                    <option value="1">Частями во время выполнения</option>
                    <option value="2">Оплата после получения результата</option>
                </select>
                <x-input-error :messages="$errors->get('payment_method')" />
            </div>
        </div>
        <div class="form_bottom">
            <i></i>
            <input type="submit" value="Создать">
        </div>
    </form>
</x-app-layout>