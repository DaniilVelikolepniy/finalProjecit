<x-layouts.app>
    <div class="max-w-2xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Редактировать отель</h2>
            <p class="text-gray-500 mb-6">Обновите данные отеля и список удобств.</p>

            <form action="{{ route('h.update', ['hotel' => $data['id']]) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Название -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Название</label>
                    <input type="text" name="name" id="name" required
                        value="{{ old('name', $data['name']) }}"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Описание -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $data['description']) }}</textarea>
                </div>

                <!-- Адрес -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Адрес</label>
                    <input type="text" name="address" id="address" required
                        value="{{ old('address', $data['address']) }}"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Картинка -->
                <div>
                    <label for="poster_url" class="block text-sm font-medium text-gray-700 mb-1">Изображение</label>
                    @if(!empty($data['poster_url']))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $data['poster_url']) }}" alt="Превью изображения"
                            class="w-32 h-24 object-cover rounded-lg shadow">
                    </div>
                    @endif
                    <input type="file" name="poster_url" id="poster_url" accept="image/*"
                        class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4 
                   file:rounded-lg file:border-0
                   file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-600
                   hover:file:bg-blue-100">
                </div>

                <!-- Удобства -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-2">Удобства</span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($facilities as $facility)
                        <label for="facility_{{ $facility->id }}"
                            class="flex items-center space-x-2 border rounded-lg p-2 cursor-pointer hover:bg-blue-50 transition">
                            <input type="checkbox"
                                name="facilities[]"
                                value="{{ $facility->id }}"
                                id="facility_{{ $facility->id }}"
                                @if(in_array($facility->id, old('facilities', $selectedFacilities ?? []))) checked @endif
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-gray-700 text-sm">{{ $facility->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>


                <!-- Кнопки -->
                <div class="flex justify-between">
                    <a href="{{ url()->previous() ?? route('home') }}"
                        class="px-5 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                        Назад
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>