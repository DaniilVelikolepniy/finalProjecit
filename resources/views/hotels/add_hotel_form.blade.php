<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Добавление отеля</title>

  <style>
    body {
      margin: 0;
      padding: 0;
    }

    body .header {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      padding: 0 15px;
      height: 10vh;
      background-color: rgba(0, 0, 255, 0.5);
    }

    body .header .headerItems {
      color: white;
      display: inline-block;
    }

    body .header a {
      padding: 15px;
      border-radius: 10px;
      height: 20px;
      width: fit-content;
      text-decoration: none;
      font-size: 20px;
      background-color: rgba(200, 200, 200, 0.5);
    }

    body .header a:hover {
      transition: all 0.5s linear;
      border-radius: 15px;
      background-color: rgba(200, 200, 200, 0.3);
    }

    body .main {
      margin: 0;
      padding: 0 25px;
      height: 90vh;
      width: calc(100vw - 50px);
      display: grid;
      justify-content: center;
      align-items: center;
    }

    body .main .form {
      background-color: #f8f8f8;
      height: 65vh;
      width: 35vw;
      border-radius: 10px;
      box-shadow: 0px 0px 40px 10px rgba(0, 0, 0, 0.5);
      display: grid;
      align-items: center;
      justify-items: center;
      justify-content: center;
      align-content: stretch;
    }

    body .main .form label {
      display: block;
      font-size: 20px;
    }

    body .main .form .input {
      margin-top: 10px;
      padding: 7px;
      width: 30vw;
      height: fit-content;
      border-radius: 7px;
      border: solid 1px black;
      font-size: 18px;
    }

    body .main .form #description {
      resize: none;
      height: 10vh;
    }

    body .main .form .buttons {
      width: 31vw;
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
      justify-content: space-between;
      align-items: flex-end;
    }

    body .main .form .button {
      display: flex;
      cursor: pointer;
      margin: 0;
      width: 12.5vw;
      height: 3vh;
      border-radius: 3px;
      border: solid 1px black;
      background-color: darkgray;
      color: black;
      font-size: 18px;
      text-decoration: none;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>
  <header class="header">
    <h1 class="headerItems">Добавление нового отеля</h1>
    <a class="headerItems" href="/">На главную</a>
  </header>
  <main class="main">
    <form action="{{ route('h.store') }}" method="post" enctype="multipart/form-data" class="form">
      @csrf
      <div class="formItems">
        <label for="name">Название</label>
        <input type="text" name="name" class="input" id="name" required>
      </div>
      <div class="formItems">
        <label for="description">Описание</label>
        <textarea type="text" name="description" class="input" id="description"required></textarea>
      </div>
      <div class="formItems">
        <label for="address">Адрес</label>
        <input type="text" name="address" class="input" id="address"required>
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
  </main>
</body>

</html>