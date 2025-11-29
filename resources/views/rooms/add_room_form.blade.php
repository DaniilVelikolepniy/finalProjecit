<x-layouts.app>
  <div class="max-w-3xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-2">Добавить комнату</h2>
      <p class="text-gray-500 mb-6">Заполните информацию о новой комнате и выберите удобства.</p>

      <form action="{{ route('r.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Название -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Название комнаты <span class="text-red-500">*</span></label>
          <input type="text" name="name" id="name" required
            value="{{ old('name') }}"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
        </div>

        <!-- Описание -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
            <textarea name="description" id="description" rows="4"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
        </div>

        <!-- Цена -->
        <div>
          <label for="price_per_night" class="block text-sm font-medium text-gray-700 mb-1">Цена за ночь (₽) <span class="text-red-500">*</span></label>
          <input type="number" name="price_per_night" id="price_per_night" required
            value="{{ old('price_per_night') }}"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('price_per_night') border-red-500 @enderror">
        </div>

        <!-- Площадь -->
        <div>
          <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Площадь номера (м²)</label>
          <input type="number" name="area" id="area"
            value="{{ old('area') }}"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('area') border-red-500 @enderror">
        </div>

        <!-- Класс -->
        <div>
          <label for="room_class" class="block text-sm font-medium text-gray-700 mb-1">Класс комнаты</label>
          <select name="room_class" id="room_class"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('room_class') border-red-500 @enderror">
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
          <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Отель <span class="text-red-500">*</span></label>
          <select name="hotel_id" id="hotel_id" required
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('hotel_id') border-red-500 @enderror">
            <option value="">Выберите отель</option>
            @foreach ($hotels as $hotel)
              <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                {{ $hotel->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Удобства -->
        <div>
          <span class="block text-sm font-medium text-gray-700 mb-2">Удобства</span>
          <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            @foreach($facilities as $facility)
              <label for="facility_{{ $facility->id }}"
                class="flex items-center space-x-2 border rounded-lg p-2 cursor-pointer hover:bg-indigo-50 transition">
                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" id="facility_{{ $facility->id }}"
                  @if(in_array($facility->id, old('facilities', []))) checked @endif
                  class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <span class="text-gray-700 text-sm">{{ $facility->name }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <!-- Изображение -->
        <div>
          <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Изображение комнаты</label>
          <input type="file" name="image" id="image" accept="image/*"
            class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4
                   file:rounded-lg file:border-0
                   file:text-sm file:font-semibold
                   file:bg-indigo-50 file:text-indigo-600
                   hover:file:bg-indigo-100">
        </div>

        <!-- Кнопки -->
        <div class="flex justify-between pt-4">
          <a href="{{ url()->previous() ?? route('home') }}"
            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 transition">
            Назад
          </a>
          <button type="submit"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg cursor-pointer shadow">
            Отправить
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layouts.app>
