# ARCHITECTURE.md

# Portal Digital SMP Muhammadiyah Unggulan Ashidiq

Version : 1.0

---

# Philosophy

Portal ini dibangun dengan prinsip:

- Clean Code
- Simple Architecture
- High Security
- Easy Maintenance
- Reusable Component
- Mobile First
- Performance First

Seluruh kode harus mudah dipahami oleh developer lain tanpa dokumentasi tambahan.

---

# Architecture

Menggunakan MVC sederhana.

```
Browser
   │
index.php
   │
Router
   │
Middleware
   │
Controller
   │
Service
   │
Repository
   │
Database
```

Rules

Controller tidak boleh query database langsung.

Controller tidak boleh berisi business logic.

View tidak boleh berisi logika.

Business logic hanya berada pada Service.

Database hanya melalui Repository.

---

# Folder Structure

```
project/

app/
    Controllers/
    Services/
    Repositories/
    Models/
    Middleware/
    Core/
    Helpers/
    Traits/
    Validators/

config/

database/

public/
    assets/
        css/
        js/
        images/
        icons/
    uploads/

resources/
    views/
        layouts/
        components/
        portal/
        admin/

routes/

storage/
    logs/
    cache/

vendor/

.env
```

---

# MVC Rules

## Controller

Tugas:

- menerima request
- validasi awal
- memanggil Service
- mengirim data ke View

Tidak boleh

- query database
- upload file
- business logic

---

## Service

Semua proses bisnis berada di sini.

Contoh

Login

Tambah aplikasi

Edit aplikasi

Generate slug

Filter search

Permission

---

## Repository

Hanya berisi query database.

Semua query menggunakan PDO Prepared Statement.

Tidak ada HTML.

---

## View

View hanya bertugas menampilkan data.

Tidak boleh

query

loop kompleks

business logic

SQL

Gunakan component.

---

# Routing

Semua route berada pada

/routes/web.php

Contoh

GET /

GET /login

POST /login

GET /admin

GET /applications

POST /applications/store

---

# Components

Semua UI harus reusable.

Minimal memiliki

Navbar

Sidebar

Footer

Hero

Card

Button

Input

Modal

Table

Badge

Alert

Pagination

Search Box

Statistic Card

Tidak boleh copy paste HTML.

---

# UI Rules

Menggunakan

Tailwind CSS

AlpineJS

Heroicons

Semua card memiliki

rounded-xl

shadow

hover

transition

responsive

Gunakan spacing yang konsisten.

---

# Naming Convention

Class

PascalCase

ApplicationController

Method

camelCase

storeApplication()

Variable

camelCase

$appName

Database

snake_case

application_name

Route

kebab-case

portal-admin

---

# Database Rules

Primary Key

id

Timestamp

created_at

updated_at

Soft Delete

deleted_at

Foreign Key

nama_tabel_id

Contoh

category_id

Semua tabel menggunakan InnoDB.

---

# Security

Seluruh query menggunakan

Prepared Statement

Password

password_hash()

password_verify()

CSRF Token

Wajib.

Session

Regenerate setelah login.

Cookie

HttpOnly

SameSite

Secure

Escape Output

htmlspecialchars()

Upload

Whitelist extension

Whitelist MIME

Rename file

Limit size

Tidak boleh execute file upload.

Role

Admin

Semua halaman admin wajib melalui middleware.

---

# Validation

Semua input wajib divalidasi.

Server Side wajib.

Client Side hanya membantu UX.

Tidak boleh percaya data dari browser.

---

# Error Handling

Gunakan try catch.

Semua error disimpan pada

/storage/logs

User hanya melihat

Terjadi kesalahan.

Jangan tampilkan error PHP.

---

# Configuration

Seluruh konfigurasi berada pada

/config

Tidak boleh hardcode

URL

Database

Email

Timezone

Path

Gunakan ENV.

---

# Assets

Pisahkan

CSS

JS

Image

Icon

Logo

Tidak boleh inline CSS.

Tidak boleh inline Javascript.

---

# Coding Standard

PSR-12

strict_types=1

Type Hint

Return Type

PHPDoc

Function maksimal ±40 baris.

Class maksimal fokus pada satu tanggung jawab.

Gunakan SOLID sederhana.

---

# Performance

Lazy Load Image

SVG Icon

Minify CSS

Minify JS

Cache Configuration

Optimized Query

Pagination

Search Debounce

---

# Design Goal

Tampilan harus menyerupai dashboard modern.

Nuansa:

Education

Professional

Islamic

Minimalist

Premium

Clean

Inspirasi desain:

- Apple
- Vercel
- Stripe
- Shadcn UI
- Dashboard SaaS modern

Portal harus terasa seperti "App Store Sekolah", di mana setiap aplikasi tampil sebagai kartu modern dengan logo, deskripsi singkat, badge kategori, hak akses, dan tombol **Buka Aplikasi**.

---

# Development Rules

Selalu utamakan:

1. Keamanan
2. Kerapihan kode
3. Reusable component
4. Kemudahan maintenance
5. Performa
6. Responsive
7. Accessibility

Jika terdapat dua solusi yang sama baiknya, pilih solusi yang:

- lebih sederhana,
- lebih aman,
- lebih mudah dipelihara,
- dan lebih sedikit dependensi.