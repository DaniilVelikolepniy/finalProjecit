<x-layouts.app>
  <div class="main p-6 max-w-3xl mx-auto">
    <form action="{{ route('r.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-6 bg-white p-6 rounded-2xl shadow-[0px_0px_40px_10px_rgba(0,0,0,0.5)]">
      @csrf

      {{-- Название комнаты --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Название комнаты <span class="text-red-500">*</span></label>
        <input type="text" name="name" id="name" required
               class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('name') border-red-500 @enderror"
               value="{{ old('name') }}">
        @error('name')
          <p class="text-red-500 text-sm mt-1 leading-[18px]">{{ $message }}</p>
        @enderror
      </div>

      {{-- Описание --}}
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full h-[120px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
        @error('description')
          <p class="text-red-500 text-sm mt-1 leading-[18px]">{{ $message }}</p>
        @enderror
      </div>

      {{-- Цена за ночь --}}
      <div>
        <label for="price_per_night" class="block text-sm font-medium text-gray-700 mb-1">Цена за ночь (₽) <span class="text-red-500">*</span></label>
        <input type="number" name="price_per_night" id="price_per_night" required
               class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('price_per_night') border-red-500 @enderror"
               value="{{ old('price_per_night') }}">
        @error('price_per_night')
          <p class="text-red-500 text-sm mt-1 leading-[18px]">{{ $message }}</p>
        @enderror
      </div>

      {{-- Площадь --}}
      <div>
        <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Площадь номера (м²)</label>
        <input type="number" name="area" id="area"
               class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('area') border-red-500 @enderror"
               value="{{ old('area') }}">
        @error('area')
          <p class="text-red-500 text-sm mt-1 leading-[18px]">{{ $message }}</p>
        @enderror
      </div>

      {{-- Класс комнаты --}}
      <div>
        <label for="room_class" class="block text-sm font-medium text-gray-700 mb-1">Класс комнаты</label>
        <select name="room_class" id="room_class"
                class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('room_class') border-red-500 @enderror">
          <option value="">Выберите класс</option>
          <option value="economy" {{ old('room_class') === 'economy' ? 'selected' : '' }}>Эконом</option>
          <option value="standard" {{ old('room_class') === 'standard' ? 'selected' : '' }}>Стандарт</option>
          <option value="comfort" {{ old('room_class') === 'comfort' ? 'selected' : '' }}>Комфорт</option>
          <option value="business" {{ old('room_class') === 'business' ? 'selected' : '' }}>Бизнес</option>
          <option value="luxury" {{ old('room_class') === 'luxury' ? 'selected' : '' }}>Люкс</option>
          <option value="presidential" {{ old('room_class') === 'presidential' ? 'selected' : '' }}>Президентский</option>
        </select>
        @error('room_class')
          <p class="text-red-500 text-sm mt-1 leading-[18px]">{{ $message }}</p>
        @enderror
      </div>

      {{-- Отель --}}
      <div>
        <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Отель <span class="text-red-500">*</span></label>
        <select name="hotel_id" id="hotel_id" required
                class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('hotel_id') border-red-500 @enderror">
          <option value="">Выберите отель</option>
          @foreach ($hotels as $hotel)
            <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
          @endforeach
        </select>
        @error('hotel_id')
          <p class="text-red-500 text-sm mt-1 leading-[18px]">{{ $message }}</p>
        @enderror
      </div>

      {{-- Изображение --}}
      <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Изображение комнаты</label>
        <input type="file" name="image" id="image" accept="image/*"
               class="w-full h-[35px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('image') border-red-500 @enderror">
        @error('image')
          <p class="text-red-500 text-sm mt-1 leading-[18px]">{{ $message }}</p>
        @enderror
      </div>

      {{-- Кнопки --}}
      <div class="flex justify-between pt-4">
        <a href="{{ url()->previous() ?? route('home') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded-lg">Назад</a>
        <input type="submit" value="Отправить"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg cursor-pointer">
      </div>
    </form>
  </div>
</x-layouts.app>
