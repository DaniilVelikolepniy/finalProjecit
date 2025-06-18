<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Отель: <?php echo $data['name']?></title>

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
            width: calc(100vw - 30px);
            height: calc(90vh - 45px);
            padding: 15px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            row-gap: 25px;
            column-gap: 25px;
        }

        body .main .secions {
            background-color: #FFC244;
            border-radius: 15px;
        }

        body .main .rows {
            padding: 20px;
            font-size: 20px;
        }

        body .main .first_row {
            grid-column: 1;
            grid-row: 1;
        }

        body .main .first_row #description {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        body .main .second_row {
            grid-column: 1;
            grid-row: 2;
        }

        body .main .column {
            grid-column: 2;
            grid-row: 1 / span 2;
            padding: 20px;
        }

        body .main .column img {
            height: 300px;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1 class="headerItems">Отель: <?php echo $data['name']?></h1>
        <a href="{{ url()->previous() ?? route('home') }}" class="headerItems">Назад</a>
        <a class="headerItems" href="/">На главную</a>
    </header>
    <main class="main">
        <div class="secions rows first_row">
            <h2>
                Описание:
            </h2>
            <p id="description">
                <?php echo $data['description']?>
            </p>
        </div>
        <div class="secions rows second_row">
            <h2>Адрес:</h2>
            <p id="address">
                <?php echo $data['address']?>
            </p>
        </div>
        <div class="secions column">
            <img src="{{ asset('storage/' . $data['poster_url']) }}" alt="Фото {{ $data['name'] }}">
        </div>
    </main>
</body>

</html>