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
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Добавить комнату</h2>
            <p class="text-gray-500 mb-8">Заполните информацию о новой комнате и выберите удобства.</p>

            <x-form-validation-errors />

            <form action="{{ route('r.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Название -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Название комнаты <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" required
                            value="{{ old('name') }}"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-300 @enderror">
                    </div>

                    <!-- Описание -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Описание</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition resize-none @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    </div>

                    <!-- Цена -->
                    <div>
                        <label for="price_per_night" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Цена за ночь (₽) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price_per_night" id="price_per_night" required
                            value="{{ old('price_per_night') }}"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('price_per_night') border-red-300 @enderror">
                    </div>

                    <!-- Площадь -->
                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700 mb-1.5">Площадь номера (м²)</label>
                        <input type="number" name="area" id="area"
                            value="{{ old('area') }}"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('area') border-red-300 @enderror">
                    </div>

                    <!-- Класс -->
                    <div>
                        <label for="room_class" class="block text-sm font-medium text-gray-700 mb-1.5">Класс комнаты</label>
                        <select name="room_class" id="room_class"
                            class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('room_class') border-red-300 @enderror">
                            <option value="">Выберите класс</option>
                            <option value="economy" {{ old('room_class') === 'economy' ? 'selected' : '' }}>Эконом</option>
                            <option value="standard" {{ old('room_class') === 'standard' ? 'selected' : '' }}>Стандарт</option>
                            <option value="comfort" {{ old('room_class') === 'comfort' ? 'selected' : '' }}>Комфорт</option>
                            <option value="business" {{ old('room_class') === 'business' ? 'selected' : '' }}>Бизнес</option>
                            <option value="luxury" {{ old('room_class') === 'luxury' ? 'selected' : '' }}>Люкс</option>
                            <option value="presidential" {{ old('room_class') === 'presidential' ? 'selected' : '' }}>Президентский</option>
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
                                <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Удобства -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-2">Удобства</span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach($facilities as $facility)
                            <label for="facility_{{ $facility->id }}"
                                class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2.5 cursor-pointer hover:bg-primary-50 hover:border-primary-200 transition has-[:checked]:bg-primary-50 has-[:checked]:border-primary-300">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" id="facility_{{ $facility->id }}"
                                    @if(in_array($facility->id, old('facilities', []))) checked @endif
                                    class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                <span class="text-sm text-gray-700">{{ $facility->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Изображение -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1.5">Изображение комнаты</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4
                               file:rounded-xl file:border-0
                               file:text-sm file:font-medium
                               file:bg-primary-50 file:text-primary-600
                               hover:file:bg-primary-100 transition">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Создать комнату
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
