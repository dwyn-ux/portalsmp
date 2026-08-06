# PRD.md

# Portal Digital SMP Muhammadiyah Unggulan Ashidiq

Versi : 1.0
Status : MVP
Platform : Web
Domain : portal.smpmuashidiq.sch.id

---

# 1. Tujuan

Membangun Portal Digital SMP Muhammadiyah Unggulan Ashidiq sebagai pusat seluruh aplikasi sekolah dengan tampilan modern, profesional, islami, dan berorientasi pendidikan.

Portal berfungsi sebagai Single Entry Point seluruh sistem digital sekolah.

---

# 2. Branding

Nama

Portal Digital
SMP Muhammadiyah Unggulan Ashidiq

Slogan

"Berkemajuan • Mandiri • Berprestasi
Menguasai Teknologi Digital • Berjiwa Qur'ani"

Tema

Modern Education
Islamic Minimalist

Nuansa

- Elegan
- Bersih
- Premium
- Futuristik
- Islami

---

# 3. Teknologi

Backend

PHP 8.2 Native

Frontend

Tailwind CSS

Javascript

AlpineJS

Database

MariaDB / MySQL

Icons

Heroicons

Deployment

Github
Shared Hosting
cPanel

Tanpa framework berat.

---

# 4. UI Style Guide

Dominan

Hijau Muhammadiyah

Secondary

Emerald

Accent

Blue Digital

Background

White
Very Light Gray

Radius

rounded-xl

Shadow

shadow-xl

Animation

hover lift

fade

glass effect

Responsive

Desktop

Tablet

Mobile

Semua halaman responsive.

---

# 5. Landing Page

Hero

Logo sekolah

Judul besar

Portal Digital

Subjudul

SMP Muhammadiyah Unggulan Ashidiq

Slogan

Button

Masuk Portal

Background

Foto sekolah

Gradient

Pattern islami transparan

---

Statistik

- Total Aplikasi
- Jumlah Guru
- Jumlah Siswa
- Sistem Terintegrasi

---

Announcement Bar

Running announcement

---

Quick Access

Filter kategori

Semua

Akademik

Tahfidz

Guru

Siswa

Administrasi

Keuangan

---

Grid Card

Setiap aplikasi tampil berupa card modern.

Isi

Logo

Nama

Deskripsi singkat

Kategori

Hak akses

Button

Buka Aplikasi

Hover

Lift

Shadow

Scale ringan

---

# 6. Detail Aplikasi

Logo

Nama

Status

Versi

Developer

Kategori

Target User

Deskripsi

Fitur

Button

Buka Aplikasi

---

# 7. Search

Realtime Search

Filter berdasarkan

Nama

Kategori

Deskripsi

---

# 8. Panel Admin

Dashboard

Statistik

Jumlah aplikasi

Kategori

Visitor

Online User

Chart Visitor

---

Menu

Dashboard

Aplikasi

Kategori

Pengumuman

Setting

Admin

Logout

---

# 9. CRUD Aplikasi

Field

Nama

Logo

Deskripsi

URL

Kategori

Urutan

Icon Color

Target User

Status

Tanggal Update

Developer

Versi

---

Hak akses

Semua

Guru

Siswa

Wali

Admin

---

# 10. CRUD Kategori

Nama

Icon

Warna

Urutan

Status

---

# 11. Pengaturan Portal

Logo

Favicon

Nama Sekolah

Slogan

Alamat

Email

Telepon

Whatsapp

Youtube

Instagram

Facebook

Background Hero

Running Text

Footer

---

# 12. Struktur Folder

/app

Controllers

Models

Services

Repositories

Helpers

Core

Middleware

Validators

Traits

Enums

/config

/database

/public

assets

uploads

css

js

images

/storage

logs

cache

/routes

/views

layouts

components

pages

admin

portal

/errors

---

# 13. Coding Standard

PSR-12

MVC

Reusable Component

DRY

SOLID

Repository Pattern

Service Layer

Helper terpisah

Config terpisah

Business Logic tidak boleh berada di View.

---

# 14. Keamanan

Password Hash

password_hash()

CSRF Protection

Session Regeneration

Prepared Statement PDO

XSS Escape

Input Validation

Rate Limiter Login

Secure Session Cookie

SameSite Cookie

HttpOnly

SQL Injection Protection

Upload Validation

Whitelist MIME

Rename File Upload

No Direct Access

Role Middleware

Audit Log

Error Log

Exception Handler

Security Headers

CSP

X-Frame

HSTS

---

# 15. Performance

Lazy Load Image

SVG Icon

Minify CSS

Minify JS

Image Compression

Cache Config

Cache Query

Autoload PSR-4

---

# 16. Coding Rules

Semua konfigurasi berada di config/

Tidak boleh ada hardcode URL.

Gunakan ENV.

Semua query menggunakan PDO Prepared Statement.

Semua View dipisah menjadi Component.

Controller maksimal menangani request.

Business Logic berada di Service.

Database berada di Repository.

View hanya HTML.

Javascript dipisah per halaman.

CSS hanya Tailwind.

Tidak boleh inline CSS.

Tidak boleh inline JS.

Semua fungsi memiliki komentar PHPDoc.

Gunakan type declaration PHP.

Strict Types aktif.

---

# 17. Target Hasil

UI harus menyerupai prototype modern dengan nuansa premium education.

Feel website seperti:

- Dashboard modern
- Apple Human Interface
- Stripe
- Vercel
- Shadcn UI
- Digabungkan dengan nuansa Islami dan identitas Muhammadiyah

Portal harus terasa seperti "App Store Sekolah", di mana setiap aplikasi tampil sebagai kartu modern yang informatif dan mudah diakses.

Kode harus clean, scalable, aman, reusable, dan mudah dikembangkan menjadi ekosistem digital sekolah dalam jangka panjang.