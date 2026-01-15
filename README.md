# Comments API — тестовое задание

Простой REST API для контента (Новости, Видео-посты) и системы комментариев с бесконечной вложенностью (ответ на комментарий — это отдельный комментарий). Реализовано в стиле “контроллер → request → DTO (Spatie Data) → action → repository (read/write) → resource”.

## Стек
- PHP 8.2+
- Laravel
- MySQL 8+
- Laravel Sanctum (аутентификация для операций с комментариями)
- spatie/laravel-data (DTO)

## Функциональность
- CRUD News
- CRUD VideoPost (+ загрузка видеофайла)
- CRUD Comment от лица пользователя к:
  - News
  - VideoPost
  - Comment (ответы любой глубины)
- При чтении News/VideoPost API отдаёт комментарии с курсорной пагинацией
- При чтении Comment API отдаёт ответы (replies) с курсорной пагинацией
- Политики доступа: редактировать/удалять комментарий может только автор

## Структура проекта
- `app/Http/Controllers/Api/*` — контроллеры
- `app/Http/Requests/*` — валидация и геттеры
- `app/Services/*/Dto` — DTO через `Data::from([...])`, без конструкторов
- `app/Services/*/Actions` — бизнес-логика
- `app/Repositories/Read/*` и `app/Repositories/Write/*` — доступ к данным
- `app/Http/Resources/*` — формирование ответа API
- `app/Policies` — политики доступа

### 1) Установка зависимостей
```bash
composer install
cp .env.example .env
php artisan key:generate
```
Создай БД в MySQL, затем укажи креды в .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=comments_api
DB_USERNAME=root
DB_PASSWORD=secret
```

API эндпоинты (основные)
Auth
POST /api/auth/register
POST /api/auth/login

News
GET /api/news?per_page=20
POST /api/news
GET /api/news/{news}?comments_per_page=20&cursor=... — комментарии курсором
PUT /api/news/{news}
DELETE /api/news/{news}

VideoPosts
GET /api/video-posts?per_page=20
POST /api/video-posts (multipart/form-data, поле video опционально)
GET /api/video-posts/{video_post}?comments_per_page=20&cursor=...
PUT /api/video-posts/{video_post}
DELETE /api/video-posts/{video_post}

Comments
GET /api/comments/{comment}?replies_per_page=20&cursor=... — ответы курсором
POST /api/comments (auth)
PUT /api/comments/{comment} (auth, только автор)
DELETE /api/comments/{comment} (auth, только автор)
