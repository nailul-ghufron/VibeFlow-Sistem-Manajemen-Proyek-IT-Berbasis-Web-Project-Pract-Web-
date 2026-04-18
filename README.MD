# VibeFlow — Sistem Manajemen Proyek IT Berbasis Web

<div align="center">

```
██╗   ██╗██╗██████╗ ███████╗███████╗██╗      ██████╗ ██╗    ██╗
██║   ██║██║██╔══██╗██╔════╝██╔════╝██║     ██╔═══██╗██║    ██║
██║   ██║██║██████╔╝█████╗  █████╗  ██║     ██║   ██║██║ █╗ ██║
╚██╗ ██╔╝██║██╔══██╗██╔══╝  ██╔══╝  ██║     ██║   ██║██║███╗██║
 ╚████╔╝ ██║██████╔╝███████╗██║     ███████╗╚██████╔╝╚███╔███╔╝
  ╚═══╝  ╚═╝╚═════╝ ╚══════╝╚═╝     ╚══════╝ ╚═════╝  ╚══╝╚══╝
```

**Versi:** 2.0 &nbsp;|&nbsp; **Status:** MVP Development &nbsp;|&nbsp; **April 2026**

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)](https://mysql.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-CDN-06B6D4?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

</div>

---

## 📋 Daftar Isi

1. [Deskripsi Proyek](#-deskripsi-proyek)
2. [Fitur Utama](#-fitur-utama)
3. [Tech Stack](#-tech-stack)
4. [Struktur Direktori](#-struktur-direktori)
5. [Instalasi & Konfigurasi](#-instalasi--konfigurasi)
6. [Database Schema](#-database-schema)
7. [Akun Demo](#-akun-demo)
8. [Alur Penggunaan](#-alur-penggunaan)
9. [API Endpoint](#-api-endpoint)
10. [Matriks Hak Akses](#-matriks-hak-akses)
11. [Keamanan](#-keamanan)
12. [Kontribusi](#-kontribusi)

---

## 📌 Deskripsi Proyek

**VibeFlow** adalah sistem manajemen proyek IT berbasis web yang dirancang khusus untuk tim pengembang perangkat lunak. Sistem ini membantu **Project Manager**, **Programmer**, dan **Klien** untuk berkolaborasi secara efektif dalam satu platform terpadu.

Sistem ini dibangun sepenuhnya menggunakan **Vanilla PHP 8** dengan pola arsitektur **MVC sederhana** (Model-View-Controller), database **MySQL 8**, dan antarmuka modern menggunakan **Tailwind CSS** serta **Vanilla JavaScript**.

> **Sektor KBLI:** 6201 — Aktivitas Pengembangan Perangkat Lunak (BPS 2020)

---

## ✨ Fitur Utama

| Fitur | Deskripsi | Status |
|-------|-----------|--------|
| 🔐 **Autentikasi & RBAC** | Login/logout dengan Role-Based Access Control untuk 4 peran berbeda | ✅ Selesai |
| 📁 **Manajemen Proyek** | CRUD proyek lengkap dengan deadline dan status tracking | ✅ Selesai |
| 🗂️ **Kanban Board** | Papan tugas drag-and-drop (To Do → In Progress → Done) | ✅ Selesai |
| 📈 **Progress Otomatis** | Kalkulasi otomatis % penyelesaian berdasarkan jumlah task `done` | ✅ Selesai |
| 📎 **Manajemen Dokumen** | Upload/download file dengan validasi MIME type & ekstensi | ✅ Selesai |
| 📊 **Laporan Proyek** | Tampilan laporan ringkasan proyek yang dapat dicetak ke PDF | ✅ Selesai |
| 🔒 **Audit Trail** | Pencatatan seluruh aktivitas sistem ke tabel `activity_logs` | ✅ Selesai |
| 📱 **Responsif** | UI yang menyesuaikan tampilan di berbagai perangkat | ✅ Selesai |

---

## 🛠️ Tech Stack

```
┌─────────────────────────────────────────────────────────────┐
│                    ARSITEKTUR SISTEM                        │
├──────────────────────┬──────────────────────────────────────┤
│  LAYER               │  TEKNOLOGI                          │
├──────────────────────┼──────────────────────────────────────┤
│  Frontend (UI)       │  HTML5 + Tailwind CSS (CDN)         │
│  Interaktivitas      │  Vanilla JavaScript (ES6+)          │
│  Backend             │  PHP 8.x (Pure / Vanilla MVC)       │
│  Database            │  MySQL 8.x via PDO + Prepared Stmt  │
│  Server Lokal        │  XAMPP / Laragon / php -S           │
│  Security            │  Bcrypt, CSRF Token, Session Guard  │
└──────────────────────┴──────────────────────────────────────┘
```

### Persyaratan Sistem

| Kebutuhan | Versi Minimum |
|-----------|---------------|
| PHP | 8.1 |
| MySQL | 8.0 |
| Browser | Chrome 110+, Firefox 110+, Edge 110+ |
| Resolusi Layar | 360px (Mobile) ke atas |

---

## 📂 Struktur Direktori

```
VibeFlow/
├── .htaccess                   # URL rewriting → semua request ke index.php
├── index.php                   # Entry point & router sederhana
├── database.sql                # Schema database & data seed awal
│
├── config/
│   └── database.php            # Konfigurasi PDO (host, db, user, pass)
│
├── helpers/
│   └── auth_guard.php          # Session guard, CSRF token, activity logger
│
├── models/
│   ├── UserModel.php           # Query autentikasi & manajemen user
│   ├── ProjectModel.php        # CRUD proyek & kalkulasi progress
│   ├── TaskModel.php           # CRUD tugas & update status Kanban
│   └── DocumentModel.php       # Manajemen rekaman file di DB
│
├── controllers/
│   ├── AuthController.php      # Login, logout, inisialisasi sesi
│   ├── DashboardController.php # Routing dashboard berdasarkan role
│   ├── ProjectController.php   # Endpoint proyek (list, detail, create)
│   ├── TaskController.php      # Endpoint tugas & update status (AJAX)
│   ├── DocumentController.php  # Upload & download file
│   └── ReportController.php    # Tampilan laporan proyek
│
├── views/
│   ├── auth/
│   │   └── login.php           # Halaman login (Glassmorphism UI)
│   ├── layouts/
│   │   ├── header.php          # Header & shell HTML utama
│   │   └── sidebar.php         # Navigasi sidebar (fixed, 256px)
│   ├── dashboard/
│   │   ├── pm.php              # Dashboard PM / Super Admin
│   │   ├── programmer.php      # Dashboard Programmer
│   │   └── client.php          # Dashboard Klien
│   ├── projects/
│   │   ├── index.php           # Daftar semua proyek (card grid)
│   │   ├── create.php          # Form pembuatan proyek baru
│   │   └── detail.php          # Detail proyek + Kanban + Dokumen
│   ├── kanban/
│   │   └── board.php           # Komponen Kanban Board (3 kolom)
│   └── reports/
│       └── project_report.php  # Laporan proyek (printable)
│
├── assets/
│   └── js/
│       └── kanban.js           # Logika Drag & Drop HTML5 + AJAX fetch
│
├── uploads/
│   └── docs/
│       └── {project_id}/       # File diorganisir per-proyek
│
└── DOC/
    └── SRS_VibeFlow_Enhanced.md  # Dokumen SRS lengkap
```

---

## ⚙️ Instalasi & Konfigurasi

### Langkah 1 — Clone / Siapkan Proyek

Pastikan folder proyek sudah berada di direktori web server Anda:

```bash
# Jika menggunakan XAMPP (Windows/Linux)
# Letakkan folder VibeFlow di: C:/xampp/htdocs/ atau /opt/lampp/htdocs/

# Jika menggunakan Laragon
# Letakkan folder VibeFlow di: C:/laragon/www/

# Jika menggunakan php built-in server
cd /path/to/VibeFlow
php -S localhost:8000
```

### Langkah 2 — Konfigurasi Database

Buka file `config/database.php` dan sesuaikan dengan pengaturan MySQL lokal Anda:

```php
<?php
define('DB_HOST', 'localhost');  // Host MySQL
define('DB_NAME', 'vibeflow_db'); // Nama database
define('DB_USER', 'root');        // Username MySQL
define('DB_PASS', '');            // Password MySQL (kosong untuk XAMPP default)
```

### Langkah 3 — Import Database

Buka phpMyAdmin atau MySQL CLI, lalu jalankan script berikut:

```bash
# Via MySQL CLI
mysql -u root -p < database.sql

# Atau via phpMyAdmin:
# 1. Buka http://localhost/phpmyadmin
# 2. Klik "Import" → pilih file database.sql
# 3. Klik "Go"
```

Script `database.sql` secara otomatis akan:
- Membuat database `vibeflow_db`
- Membuat semua tabel (`users`, `projects`, `tasks`, `documents`, `activity_logs`)
- Menyisipkan 4 akun demo awal

### Langkah 4 — Izin Folder Upload

Pastikan folder `uploads/` dapat ditulis oleh web server:

```bash
# Linux/macOS
chmod -R 755 uploads/

# Atau jika menggunakan Apache/Nginx
chown -R www-data:www-data uploads/
```

### Langkah 5 — Akses Aplikasi

Buka browser dan navigasikan ke:

```
http://localhost:8000         # Jika menggunakan php built-in server
http://localhost/VibeFlow     # Jika menggunakan XAMPP
```

Anda akan diredirect ke halaman login secara otomatis.

---

## 🗄️ Database Schema

Aplikasi menggunakan database `vibeflow_db` dengan 5 tabel utama:

```
┌─────────────────────────────────────────────────────────┐
│                  ENTITY RELATIONSHIP                    │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  users ──(1:N)──► projects (sebagai client_id)         │
│  users ──(1:N)──► projects (sebagai pm_id)             │
│  users ──(1:N)──► tasks (sebagai programmer_id)        │
│  users ──(1:N)──► documents (sebagai uploader_id)      │
│  users ──(1:N)──► activity_logs                        │
│                                                         │
│  projects ──(1:N)──► tasks                             │
│  projects ──(1:N)──► documents                         │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

### Tabel `users`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | INT PK AUTO_INCREMENT | ID unik pengguna |
| `name` | VARCHAR(100) | Nama lengkap |
| `email` | VARCHAR(100) UNIQUE | Email untuk login |
| `password` | VARCHAR(255) | Hash Bcrypt |
| `role` | ENUM | `super_admin` / `pm` / `programmer` / `client` |
| `is_active` | TINYINT(1) | Status aktif akun |
| `created_at` | DATETIME | Waktu registrasi |
| `last_login` | DATETIME | Login terakhir |

### Tabel `projects`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | INT PK | ID proyek |
| `title` | VARCHAR(150) | Nama proyek |
| `client_id` | INT FK | Klien pemilik |
| `pm_id` | INT FK | PM pengelola |
| `status` | ENUM | `planning` / `active` / `completed` / `archived` |
| `deadline` | DATE | Tenggat waktu |
| `progress` | TINYINT | Persentase 0–100 (auto-calculated) |

### Tabel `tasks`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | INT PK | ID tugas |
| `project_id` | INT FK | Proyek induk |
| `programmer_id` | INT FK | Developer yang ditugaskan |
| `title` | VARCHAR(150) | Judul tugas |
| `priority` | ENUM | `low` / `medium` / `high` |
| `status` | ENUM | `todo` / `in_progress` / `done` |
| `due_date` | DATE | Tenggat tugas |

### Tabel `documents`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | INT PK | ID dokumen |
| `project_id` | INT FK | Proyek terkait |
| `file_name` | VARCHAR(255) | Nama asli file |
| `file_path` | VARCHAR(255) | Lokasi penyimpanan di server |
| `file_size` | INT | Ukuran dalam bytes |
| `file_type` | VARCHAR(50) | MIME type |

---

## 👤 Akun Demo

Semua akun menggunakan password yang sama: **`password123`**

| Role | Email | Akses |
|------|-------|-------|
| 🛡️ Super Admin | `admin@vibeflow.com` | Akses penuh ke seluruh sistem |
| 👔 Project Manager | `pm@vibeflow.com` | Buat/kelola proyek & tugas |
| 💻 Programmer | `dev@vibeflow.com` | Kerjakan tugas, update Kanban |
| 🤝 Client | `client@vibeflow.com` | Pantau progres, lihat laporan |

---

## 🔄 Alur Penggunaan

### Alur Utama (End-to-End)

```
1. [PM] Login → Buat Proyek Baru → Tentukan Klien & Deadline
        │
        ▼
2. [PM] Buka Detail Proyek → Tambah Task → Assign ke Programmer
        │
        ▼
3. [Programmer] Login → Buka Proyek → Geser Task di Kanban Board
   (To Do → In Progress → Done)
        │
        ▼
4. [Sistem] Otomatis kalkulasi ulang % Progress Proyek
        │
        ▼
5. [Klien] Login → Lihat progres real-time & laporan
```

### Alur Kanban Board

Programmer dapat memindahkan kartu tugas antar kolom dengan cara **drag-and-drop**:

```
┌──────────────┐    drag    ┌──────────────┐    drag    ┌──────────────┐
│   📋 To Do   │ ─────────► │ ⚡ In Progress│ ─────────► │  ✅ Done     │
│              │            │              │            │              │
│  [Task A]    │            │  [Task B]    │            │  [Task C]    │
│  [Task D]    │            │              │            │              │
└──────────────┘            └──────────────┘            └──────────────┘
     Abu-abu                    Kuning-Oranye               Emerald Hijau
```

Setiap perpindahan kartu secara otomatis:
1. Memanggil endpoint `POST /tasks/update_status` via `fetch` API
2. Memperbarui kolom `status` di database
3. Merecalculate `progress` proyek
4. Mengupdate progress bar secara real-time di halaman

---

## 🔌 API Endpoint

| Method | Endpoint | Aksi | Role |
|--------|----------|------|------|
| GET | `/auth/login` | Tampilkan form login | Publik |
| POST | `/auth/login` | Proses autentikasi | Publik |
| GET | `/auth/logout` | Hapus sesi & redirect | Semua |
| GET | `/dashboard` | Dashboard berdasarkan role | Semua |
| GET | `/projects` | Daftar proyek | Semua |
| GET | `/projects/create` | Form buat proyek | PM, Super Admin |
| POST | `/projects/create` | Simpan proyek baru | PM, Super Admin |
| GET | `/projects/detail/{id}` | Detail proyek | Semua |
| POST | `/tasks/create` | Buat task baru | PM, Super Admin |
| POST | `/tasks/update_status` | Update status Kanban (JSON) | PM, Programmer |
| POST | `/documents/upload` | Upload file | PM, Programmer |
| GET | `/documents/download/{id}` | Download file | Semua |
| GET | `/reports/project/{id}` | Laporan proyek | PM, Client |

### Contoh Request: Update Status Task

```http
POST /tasks/update_status
Content-Type: application/json

{
  "task_id": 5,
  "new_status": "in_progress"
}
```

```json
// Response
{
  "success": true,
  "progress": 45
}
```

---

## 🔐 Matriks Hak Akses

| Fitur | Super Admin | Project Manager | Programmer | Client |
|-------|:-----------:|:---------------:|:----------:|:------:|
| Kelola Akun Pengguna | ✅ | ❌ | ❌ | ❌ |
| Lihat Semua Proyek | ✅ | ✅ (miliknya) | ✅ (ditugaskan) | ✅ (miliknya) |
| Buat / Edit Proyek | ✅ | ✅ | ❌ | ❌ |
| Buat / Hapus Tugas | ✅ | ✅ | ❌ | ❌ |
| Update Status Kanban | ✅ | ✅ | ✅ | ❌ |
| Upload Dokumen | ✅ | ✅ | ✅ | ❌ |
| Download Dokumen | ✅ | ✅ | ✅ | ✅ |
| Lihat Laporan | ✅ | ✅ | ❌ | ✅ |
| Lihat Activity Log | ✅ | ❌ | ❌ | ❌ |

---

## 🔒 Keamanan

Sistem mengimplementasikan beberapa lapisan keamanan sesuai dengan standar OWASP:

### 1. Autentikasi & Sesi
- Password di-hash menggunakan **Bcrypt** (`password_hash()`)
- Session dikonfigurasi dengan `httponly` dan `SameSite=Strict`
- Setiap halaman terproteksi memanggil `auth_guard.php`

### 2. Proteksi CSRF
- Setiap form POST menyertakan **CSRF token** tersembunyi
- Token divalidasi sebelum memproses data apapun

### 3. Proteksi SQL Injection
- Seluruh query database menggunakan **PDO Prepared Statements**
- Tidak ada query string yang dibangun secara langsung dari input user

### 4. Isolasi Data
- Klien hanya bisa melihat proyek yang `client_id`-nya sesuai sesinya
- PM hanya bisa melihat proyek yang `pm_id`-nya sesuai sesinya
- Programmer hanya melihat tugas yang `programmer_id`-nya sesuai

### 5. Keamanan Upload File
```
Alur Validasi Upload:
1. Cek ukuran file → Max 10MB
2. Cek ekstensi → Whitelist: pdf, doc, docx, png, jpg, jpeg, zip, rar
3. Cek MIME type → via finfo_file() (bukan dari $_FILES['type'])
4. Generate nama file baru → uniqid() + hash pendek
5. Simpan ke uploads/docs/{project_id}/
6. Akses hanya via controller (bukan URL langsung)
```

---

## 📐 Desain UI

### Tema Visual

| Elemen | Nilai |
|--------|-------|
| Background | `#0f172a` (Slate 900) |
| Card | Glassmorphism (`bg-white/5 backdrop-blur-xl border border-white/10`) |
| Teks Utama | `text-slate-100` |
| Teks Sekunder | `text-slate-400` |
| Aksen Utama | Cyan (`#22d3ee`) |
| Sukses | Emerald (`#34d399`) |
| Peringatan | Yellow (`#facc15`) |
| Bahaya | Rose (`#fb7185`) |
| Font | Inter (Google Fonts) |

### Progress Bar Color Logic

```
progress < 30%   → Merah (Rose)
progress 30–70%  → Kuning (Yellow)
progress > 70%   → Hijau (Emerald)
```

---

## 🤝 Kontribusi

Proyek ini dikembangkan sebagai sistem internal. Untuk saran atau pelaporan bug:

1. Buka issue baru di repository
2. Sertakan langkah reproduksi yang jelas
3. Cantumkan versi PHP dan MySQL yang digunakan

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan akademis dan internal tim. Seluruh hak cipta dimiliki oleh **Tim Pengembang VibeFlow**.

---

<div align="center">
  <sub>Dibangun dengan ❤️ oleh Tim VibeFlow · April 2026</sub>
</div>
