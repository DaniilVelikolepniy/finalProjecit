<x-layouts.app>
  <div class="main">
    <form action="{{ route('h.store') }}" method="post" enctype="multipart/form-data" class="form">
      @csrf
      <div class="formItems">
        <label for="name">Название</label>
        <input type="text" name="name" class="input" id="name" required>
      </div>
      <div class="formItems">
        <label for="description">Описание</label>
        <textarea type="text" name="description" class="input" id="description" required></textarea>
      </div>
      <div class="formItems">
        <label for="address">Адрес</label>
        <input type="text" name="address" class="input" id="address" required>
      </div>
      <div class="formItems">
        <label for="poster_url">Добавьте изображение</label>
        <input type="file" name="poster_url" class="input" id="poster_url" accept="image/*">
      </div>
      <div class="formItems buttons">
        <a href="{{ url()->previous() ?? route('home') }}" class="button">Назад</a>
        <input type="submit" value="Отправить" class="button">
      </div>
    </form>
  </div>
</x-layouts.app>