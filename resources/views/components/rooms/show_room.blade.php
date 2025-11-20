<x-layouts.app>
    <div class="max-w-6xl mx-auto p-6">
        <!-- Кнопка назад -->
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center mb-4 text-gray-600 hover:text-gray-800 font-medium">
            ← Назад
        </a>

        <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Изображение комнаты -->
            <div class="md:w-2/5 h-64 md:h-auto bg-gray-200">
                @if($room->poster_url)
                    <img src="{{ asset('storage/' . $room->poster_url) }}"
                         alt="{{ $room->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        Нет изображения
                    </div>
                @endif
            </div>

            <!-- Информация о комнате -->
            <div class="md:w-3/5 p-6 flex flex-col justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-2">{{ $room->name }}</h1>
                    <p class="text-gray-600 mb-2">{{ $room->floor_area }} м² • Тип: {{ ucfirst($room->type) }}</p>
                    <p class="text-gray-700 mb-4">{{ $room->description }}</p>

                    <!-- Удобства -->
                    @if($room->facilities->isNotEmpty())
                        <div class="mb-4">
                            <h2 class="font-semibold mb-2">Удобства:</h2>
                            <ul class="flex flex-wrap gap-2">
                                @foreach($room->facilities as $facility)
                                    <li class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                        {{ $facility->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Информация об отеле и действия -->
                <div class="mt-6 flex flex-col md:flex-row md:justify-between md:items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-gray-600">Отель: <span class="font-medium">{{ $room->hotel->name }}</span></p>
                    </div>
                    <div>
                        <a href="{{ url()->previous() }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition-colors duration-200">
                            Назад
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
