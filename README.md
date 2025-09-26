Laravel 12, PHP 8.2, проект заточен под Laravel Sail (Docker).

# Все консольные команды необходимо выполнять в корне проекта

## Создадим файл .env
```
cp .env.example .env
```

## Устанавливаем зависимости в проекте
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

## Развернём окружение
```bash
./vendor/bin/sail up -d
```

## Сгенерируем ключ приложения
```bash
./vendor/bin/sail artisan key:generate
```

## Выполним миграции
```bash
./vendor/bin/sail artisan migrate
```

## Сидируем базу данных
```bash
./vendor/bin/sail artisan db:seed
```

## Переходим в бразуер для дальнейшего взаимодействия с приложением
[Наш проект](http://localhost/)