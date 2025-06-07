<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список отелей</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
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
            padding: 25px;
            width: calc(100vw - 50px);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            height: 85vh;
        }

        body .main .table {
            width: calc(100vw - 30px);
            background-color: rgba(128, 128, 128, 0.2);
            border-radius: 10px;
        }

        body .main .table::-webkit-scrollbar {
            display: none;
        }

        body .main .table .tableHeader,
        body .main .table .tableBody {
            width: 100%;
        }

        body .main .table .tableHeader {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            background-color: rgba(120, 120, 120, 0.5);
            border-radius: 10px 10px 0 0;

        }

        body .main .table .tableHeader p {
            display: block;
            width: 150px;
            text-align: center;
        }

        body .main .table .tableBody {
            display: flex;
            flex-direction: column;
        }

        body .main .table .tableBody .row {
            margin: 5px 0;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            background-color: rgba(120, 120, 120, 0.3);
            border-radius: 10px;
            height: 80px;
            text-decoration: none;
            color: black;
        }

        body .main .table .tableBody .row p {
            display: block;
            width: 150px;
            text-align: center;
            overflow-y: scroll;
            max-height: 50px;
            vertical-align: center;
        }

        body .main .table .tableBody .row a {
            display: block;
            width: 150px;
            text-align: center;
            min-height: fit-content;
            max-height: 50px;
            vertical-align: center;
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 0;
        }

        body .main .table .tableBody .row #change {
            background-color: yellowgreen;
        }

        body .main .table .tableBody .row #delete {
            background-color: rgba(253, 108, 108, 0.5);
        }

        body .main .table .tableBody .row p::-webkit-scrollbar {
            display: none;
        }

        body .main .table .tableBody .row button {
            height: 40px;
            border: 0;
            border-radius: 15px;
            cursor: pointer;
            width: 150px;
        }

        body .main .buttons {
            display: flex;
            align-content: center;
            justify-content: space-around;
            height: 100px;
            width: 100%;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .button {
            display: inline-block;
            border: none;
            height: 50px;
            width: 175px;
            line-height: 50px;
            border-radius: 15px;
            background-color: #9ca3af;
            cursor: pointer;
            text-decoration: none;
            color: black;
            text-align: center;
        }

        .message-block {
            position: absolute;
            display: flex;
            flex-direction: row;
            justify-content: center;

            margin-top: calc(5vh - 25px);
            margin-left: calc(50vw - 200px);
            padding: 10px;
            box-shadow: 0 0 50px 20px rgba(80, 80, 80, 0.5);
            border-radius: 15px;
            background-color: white;
            width: 400px;
            min-height: 50px;
        }

        .message-block .message {
            max-width: 380px;
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            font-weight: bold;
            color: #721c24;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #f5c6cb;
        }
    </style>
</head>

<body>
    @if(session()->has('message'))
    <div class="message-block" id="message-block">
        <p class="message">{{ session()->get('message') }}</p>
        <button class="close-btn" onclick="closeMessageBlock()">×</button>
    </div>
    @endif
    <header class="header">
        <h1 class="headerItems">Список отелей</h1>
        <a class="headerItems" href='/'>На главную</a>
        <a class="headerItems" href="{{ route('h.create') }}">Форма добавления отеля</a>
    </header>
    <main class="main">
        <div class="table">
            <div class="tableHeader">
                <p>Название отеля</p>
                <p>Подробности</p>
                <p>Изменение</p>
                <p>Удаление</p>
            </div>
            <div class="tableBody">
                <?php
                $lenght = count($data);
                $i = 0;
                ?>
                @while ($i <$lenght)
                    <div class="row">
                    <p><?php echo $data[$i]['name']; ?></p>
                    <a href="{{ route('h.show', ['hotel' => $data[$i]['id']]) }}">Посмотреть подробности</a>
                    <a href="{{ route('h.edit', ['hotel' => $data[$i]['id']]) }}" id="change">Изменить</a>
                    <form action="{{ route('h.destroy', ['hotel' => $data[$i]['id']]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="delete">Удалить</button>
                    </form>

            </div>
            <?php $i++ ?>
            @endwhile
        </div>
    </main>
</body>

</html>