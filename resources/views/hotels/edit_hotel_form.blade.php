<x-layouts.app>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <a href="{{ url()->previous() ?? route('home') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Назад
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Редактировать отель</h2>
            <p class="text-gray-500 mb-8">Обновите данные отеля и список удобств.</p>

            <x-form-validation-errors />

            <form action="{{ route('h.update', ['hotel' => $data['id']]) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Название -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Название</label>
                    <input type="text" name="name" id="name" required
                        value="{{ old('name', $data['name']) }}"
                        class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                </div>

                <!-- Описание -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Описание</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition resize-none">{{ old('description', $data['description']) }}</textarea>
                </div>

                <!-- Адрес -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">Адрес</label>
                    <input type="text" name="address" id="address" required
                        value="{{ old('address', $data['address']) }}"
                        class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                </div>

                <!-- Картинка -->
                <div>
                    <label for="poster_url" class="block text-sm font-medium text-gray-700 mb-1.5">Изображение</label>
                    @if(!empty($data['poster_url']))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $data['poster_url']) }}" alt="Превью изображения"
                            class="w-32 h-24 object-cover rounded-xl shadow-sm border border-gray-100">
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
                        @foreach($facilities as $facility)
                        <label for="facility_{{ $facility->id }}"
                            class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2.5 cursor-pointer hover:bg-primary-50 hover:border-primary-200 transition has-[:checked]:bg-primary-50 has-[:checked]:border-primary-300">
                            <input type="checkbox"
                                name="facilities[]"
                                value="{{ $facility->id }}"
                                id="facility_{{ $facility->id }}"
                                @if(in_array($facility->id, old('facilities', $data['facilities'] ?? []))) checked @endif
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
