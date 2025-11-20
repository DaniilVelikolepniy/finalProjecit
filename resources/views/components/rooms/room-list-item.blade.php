<div {{ $attributes->merge(['class' => 'flex flex-col md:flex-row shadow-md']) }}>
    <div class="h-full w-full md:w-2/5">
        <?php
        $image = asset('storage/' . $room->poster_url);
        ?>
        <div class="h-64 w-full bg-cover bg-center bg-no-repeat" style="background-image: url(<?php echo $image ?>)">
        </div>
    </div>
    <div class="p-4 w-full md:w-3/5 flex flex-col justify-between relative">
        @if(auth()->check() && (
        auth()->user()->isAdmin() ||
        (auth()->user()->isEditor() && $room->hotel->editor_id === auth()->id())
        ))
            <a href="{{ route('r.edit', $room->id) }}"
               class="absolute top-0 right-0 mt-2 mr-2 bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded shadow">
                ✎ Редактировать
            </a>
            <form action="{{ route('r.destroy', $room->id) }}" method="POST"
                  class="absolute top-[40px] right-0 mr-2"
                  onsubmit="return confirm('Вы уверены, что хотите удалить эту комнату?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded shadow mt-1">
                    🗑 Удалить
                </button>
            </form>
        @endif

        <div class="pb-2">
            <div class="text-xl font-bold">
                {{ $room->name }}
            </div>
            <div>
                <span>•</span> {{ $room->floor_area }} м
            </div>
            <div>
                @foreach($room->facilities as $facility)
                    <span>• {{ $facility->name }} </span>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="flex justify-end pt-2 space-x-4">
            <div class="flex flex-col text-right">
                <span class="text-lg font-bold">{{ $room->total_price }} руб.</span>
                <span>за {{ $room->total_days }} ночей</span>
            </div>

            <!-- Кнопка Подробнее -->
            <a href="{{ route('r.show', $room->id) }}"
               class="inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white text-sm px-4 py-2 rounded shadow transition-colors duration-200">
                Подробнее
            </a>

            <!-- Кнопка Забронировать -->
            <form class="ml-2" method="POST" action="{{ route('b.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="started_at" value="{{ $room->startDate }}">
                <input type="hidden" name="finished_at" value="{{ $room->endDate }}">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="price" value="{{ $room->total_price }}">
                <input type="hidden" name="days" value="{{ $room->total_days }}">
                <x-the-button class="h-full w-full">{{ __('Забронировать') }}</x-the-button>
            </form>
        </div>
    </div>
</div>
