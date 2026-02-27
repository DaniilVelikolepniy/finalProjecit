<x-layouts.app>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <a href="{{ url()->previous() ?? route('home') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Назад
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Редактировать комнату</h2>
            <p class="text-gray-500 mb-8">Обновите информацию о комнате.</p>

            <x-form-validation-errors />

            <form action="{{ route('r.update', ['room' => $data['id']]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Название -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Название комнаты <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" required
                            value="{{ old('name', $data['name']) }}"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-300 @enderror">
                    </div>

                    <!-- Описание -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Описание</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition resize-none @error('description') border-red-300 @enderror">{{ old('description', $data['description']) }}</textarea>
                    </div>

                    <!-- Цена -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Цена за ночь (₽) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price" id="price" required
                            value="{{ old('price', $data['price']) }}"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('price') border-red-300 @enderror">
                    </div>

                    <!-- Площадь -->
                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700 mb-1.5">Площадь номера (м²)</label>
                        <input type="number" name="area" id="area"
                            value="{{ old('area', $data['floor_area']) }}"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('area') border-red-300 @enderror">
                    </div>

                    <!-- Класс -->
                    <div>
                        <label for="room_class" class="block text-sm font-medium text-gray-700 mb-1.5">Класс комнаты</label>
                        <select name="room_class" id="room_class"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('room_class') border-red-300 @enderror">
                            <option value="">Выберите класс</option>
                            <option value="economy" {{ old('room_class', $data['type']) === 'economy' ? 'selected' : '' }}>Эконом</option>
                            <option value="standard" {{ old('room_class', $data['type']) === 'standard' ? 'selected' : '' }}>Стандарт</option>
                            <option value="comfort" {{ old('room_class', $data['type']) === 'comfort' ? 'selected' : '' }}>Комфорт</option>
                            <option value="business" {{ old('room_class', $data['type']) === 'business' ? 'selected' : '' }}>Бизнес</option>
                            <option value="luxury" {{ old('room_class', $data['type']) === 'luxury' ? 'selected' : '' }}>Люкс</option>
                            <option value="presidential" {{ old('room_class', $data['type']) === 'presidential' ? 'selected' : '' }}>Президентский</option>
                        </select>
                    </div>

                    <!-- Отель -->
                    <div>
                        <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Отель <span class="text-red-500">*</span>
                        </label>
                        <select name="hotel_id" id="hotel_id" required
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('hotel_id') border-red-300 @enderror">
                            <option value="">Выберите отель</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}" {{ old('hotel_id', $data['hotel_id']) == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Изображение -->
                <div>
                    <label for="poster_url" class="block text-sm font-medium text-gray-700 mb-1.5">Изображение комнаты</label>
                    @if (!empty($data['poster_url']))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $data['poster_url']) }}" alt="Текущее изображение комнаты"
                            class="w-40 h-28 object-cover rounded-xl shadow-sm border border-gray-100">
                    </div>
                    @endif
                    <input type="file" name="poster_url" id="poster_url" accept="image/*"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4
                               file:rounded-xl file:border-0
                               file:text-sm file:font-medium
                               file:bg-primary-50 file:text-primary-600
                               hover:file:bg-primary-100 transition">
                </div>

                <!-- Удобства -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-2">Удобства</span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach ($facilities as $facility)
                            <label for="edit_facility_{{ $facility->id }}"
                                class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2.5 cursor-pointer hover:bg-primary-50 hover:border-primary-200 transition has-[:checked]:bg-primary-50 has-[:checked]:border-primary-300">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" id="edit_facility_{{ $facility->id }}"
                                    {{ (is_array(old('facilities', $roomFacilities)) && in_array($facility->id, old('facilities', $roomFacilities))) ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                <span class="text-sm text-gray-700">{{ $facility->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="flex justify-between pt-4 border-t border-gray-100">
                    <a href="{{ url()->previous() ?? route('home') }}"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                        Отмена
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-6 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-xl shadow-sm hover:bg-primary-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
