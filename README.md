### Информация

Данный пакет предназначен для логирования действий пользователей в CMS системе IR site основанной на фреймворке Laravel.

### Установка

```
$ composer require avl/logger
```

```json
{
    "require": {
        "avl/logger": "^1.0"
    }
}
```
### Настройка

Для публикации опубликации файла настроек необходимо выполнить команду:

```
$ php artisan vendor:publish --provider="Avl\Logger\AvlLoggerServiceProvider"
```
