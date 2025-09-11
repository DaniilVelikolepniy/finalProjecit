<x-layouts.app>

  <div class="main p-6 max-w-3xl mx-auto">
    <form action="{{ route('r.update', ['room' => $data['id']]) }}" method="POST" enctype="multipart/form-data"
      class="space-y-6 bg-white p-6 rounded-2xl shadow-[0px_0px_40px_10px_rgba(0,0,0,0.5)]">
      @csrf
      @method('PUT')
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Название комнаты <span class="text-red-500">*</span></label>
        <input type="text" name="name" id="name" required
          class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('name') border-red-500 @enderror"
          value="{{ $data['name'] }}">
      </div>
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea name="description" id="description" rows="4"
          class="w-full h-[120px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('description') border-red-500 @enderror">{{ $data['description'] }}</textarea>
      </div>
      <div>
        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Цена за ночь (₽) <span class="text-red-500">*</span></label>
        <input type="number" name="price" id="price" required
          class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('price_per_night') border-red-500 @enderror"
          value="{{ $data['price'] }}">
      </div>
      <div>
        <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Площадь номера (м²)</label>
        <input type="number" name="area" id="area"
          class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('area') border-red-500 @enderror"
          value="{{ $data['floor_area'] }}">
      </div>
      <div>
        <label for="room_class" class="block text-sm font-medium text-gray-700 mb-1">Класс комнаты</label>
        <select name="room_class" id="room_class"
          class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('room_class') border-red-500 @enderror">
          <option value="">Выберите класс</option>
          <option value="economy" {{ old('room_class', $data['type']) === 'economy' ? 'selected' : '' }}>Эконом</option>
          <option value="standard" {{ old('room_class', $data['type']) === 'standard' ? 'selected' : '' }}>Стандарт</option>
          <option value="comfort" {{ old('room_class', $data['type']) === 'comfort' ? 'selected' : '' }}>Комфорт</option>
          <option value="business" {{ old('room_class', $data['type']) === 'business' ? 'selected' : '' }}>Бизнес</option>
          <option value="luxury" {{ old('room_class', $data['type']) === 'luxury' ? 'selected' : '' }}>Люкс</option>
          <option value="presidential" {{ old('room_class', $data['type']) === 'presidential' ? 'selected' : '' }}>Президентский</option>
        </select>
      </div>
      <div>
        <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Отель <span class="text-red-500">*</span></label>
        <select name="hotel_id" id="hotel_id" required
          class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('hotel_id') border-red-500 @enderror">
          <option value="">Выберите отель</option>
          @foreach ($hotels as $hotel)
          <option value="{{ $hotel->id }}" {{ old('hotel_id', $data['hotel_id']) == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label for="poster_url" class="block text-sm font-medium text-gray-700 mb-1">Изображение комнаты</label>
        @if (!empty($data['poster_url']))
        <div class="mb-3">
          <img src="{{ asset('storage/' . $data['poster_url']) }}" alt="Текущее изображение комнаты"
            class="w-48 h-auto rounded-lg shadow">
        </div>
        @endif
        <input type="file" name="poster_url" id="poster_url" accept="image/*"
          class="w-full h-[35px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('image') border-red-500 @enderror">
      </div>


      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Удобства</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
          @foreach ($facilities as $facility)
          <label class="flex items-center space-x-2 bg-gray-50 hover:bg-gray-100 p-2 rounded-lg border">
            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
              class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
              {{ (is_array(old('facilities', $roomFacilities)) && in_array($facility->id, old('facilities', $roomFacilities))) ? 'checked' : '' }}>
            <span class="text-sm text-gray-700">{{ $facility->name }}</span>
          </label>
          @endforeach
        </div>
      </div>

      <div class="flex justify-between pt-4">
        <a href="{{ url()->previous() ?? route('home') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded-lg">Назад</a>
        <input type="submit" value="Отправить"
          class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg cursor-pointer">
      </div>
    </form>
  </div>
</x-layouts.app>