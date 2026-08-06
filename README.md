# Portal Digital SMP Muhammadiyah Unggulan Ashidiq

Portal digital sebagai single entry point seluruh sistem digital sekolah.

## Tech Stack

- PHP 8.2 Native
- Tailwind CSS
- AlpineJS
- MariaDB / MySQL

## Installation

1. Clone repo
2. `cp .env.example .env` lalu isi konfigurasi
3. Import `database/portal.sql` ke MySQL
4. `composer install`
5. Buka `/public` atau redirect ke `index.php`

## Login

- Email: `admin@smpmuashidiq.sch.id`
- Password: `admin123`

## Struktur

```
app/            Controllers, Models, Services, Middleware, Helpers, Core
config/         Konfigurasi aplikasi
database/       SQL schema
public/         Assets, uploads
resources/views/layouts, components, portal, admin
routes/         web.php
storage/        logs, cache
```
