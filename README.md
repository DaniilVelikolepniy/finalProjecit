Laravel 12, PHP 8.2, проект заточен под Laravel Sail (Docker).

## Устанавливаем зависимости в проекте
```composer install```

## Далее запускаем докер, а в консоли выполняем команду
```./vendor/bin/sail up -d```

## Далее переходим в терминал контейнера final_project_php-laravel-laravel.test-1 и выполняем миграции
```php artisan migrate```

## После чего запускаем фабрики (в том же терминале)
```php artisan db:seed```