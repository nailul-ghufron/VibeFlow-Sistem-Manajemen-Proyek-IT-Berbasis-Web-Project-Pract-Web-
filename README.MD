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

**Versi:** 2.3 &nbsp;|&nbsp; **Status:** Feature Release &nbsp;|&nbsp; **Mei 2026**

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
13. [Riwayat Perubahan](#-riwayat-perubahan)

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
| 📁 **CRUD Proyek** | Buat, baca, edit, dan hapus proyek dengan pemilihan PM oleh Super Admin | ✅ Selesai |
| 🗂️ **CRUD Tugas (Kanban)** | Papan tugas drag-and-drop + edit & hapus tugas dari modal/hover card | ✅ Selesai |
| 📈 **Progress Otomatis** | Kalkulasi otomatis % penyelesaian berdasarkan jumlah task `done` | ✅ Selesai |
| 📎 **Manajemen Dokumen** | Upload/download file dengan validasi MIME type & ekstensi | ✅ Selesai |
| 📊 **Laporan Proyek** | Tampilan laporan ringkasan proyek yang dapat dicetak ke PDF | ✅ Selesai |
| 🔒 **Audit Trail** | Pencatatan seluruh aktivitas sistem ke tabel `activity_logs` | ✅ Selesai |
| 🎨 **Redesain UI Premium** | Halaman login & detail proyek didesain ulang dengan glassmorphism & tipografi modern | ✅ Selesai |
| 📱 **Responsif** | UI yang menyesuaikan tampilan di berbagai perangkat | ✅ Selesai |
| 🔗 **Open Graph Meta Tags** | Tampilan logo & deskripsi otomatis saat link dibagikan di media sosial | ✅ Selesai |

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
│  Kontainer           │  Docker + Docker Compose            │
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
│   ├── ProjectModel.php        # CRUD proyek, kalkulasi progress & statistik dashboard
│   ├── TaskModel.php           # CRUD tugas & update status Kanban
│   └── DocumentModel.php       # Manajemen rekaman file di DB
│
├── controllers/
│   ├── AuthController.php      # Login, logout, inisialisasi sesi
│   ├── DashboardController.php # Routing dashboard berdasarkan role + fetch statistik DB
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
│   │   ├── index.php           # Daftar semua proyek (card grid) + tombol edit
│   │   ├── create.php          # Form pembuatan proyek baru (+ pilihan PM untuk Super Admin)
│   │   ├── edit.php            # Form edit proyek (update & konfirmasi hapus)
│   │   └── detail.php          # Detail proyek redesign + Kanban + Dokumen
│   ├── kanban/
│   │   └── board.php           # Kanban Board: 3 kolom, edit/hapus task via modal & hover
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
    ├── SRS_VibeFlow_Enhanced.md  # Dokumen SRS lengkap
    └── test.md                   # Test plan & checklist QA
```

---

## ⚙️ Instalasi & Konfigurasi

Terdapat dua metode instalasi: **Docker** (direkomendasikan) dan **manual** (XAMPP/Laragon).

---

### Metode A — Docker (Direkomendasikan)

Metode ini menyiapkan PHP + MySQL secara otomatis dalam satu perintah.

**Prasyarat:** Docker & Docker Compose terinstal di sistem Anda.

```bash
# 1. Masuk ke direktori proyek
cd /path/to/VibeFlow

# 2. Jalankan semua layanan (web + db) dalam mode background
docker compose up -d --build
```

> File `database.sql` otomatis diimpor saat container `db` pertama kali dibuat via `docker-entrypoint-initdb.d`.

**Konfigurasi database untuk Docker** sudah tersedia di `config/database.php`:

```php
define('DB_HOST', 'db');           // nama service docker
define('DB_NAME', 'vibeflow_db');
define('DB_USER', 'vibeuser');
define('DB_PASS', 'vibepassword');
```

Akses aplikasi di: **`http://localhost:8000`**

---

### Metode B — Manual (XAMPP / Laragon)

**Langkah 1** — Letakkan folder proyek di direktori web server:

```bash
# XAMPP Windows: C:/xampp/htdocs/VibeFlow
# Laragon:       C:/laragon/www/VibeFlow
# XAMPP Linux:   /opt/lampp/htdocs/VibeFlow
```

**Langkah 2** — Sesuaikan `config/database.php` untuk MySQL lokal:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'vibeflow_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // kosong untuk XAMPP default
```

**Langkah 3** — Import database via MySQL CLI atau phpMyAdmin:

```bash
mysql -u root -p < database.sql
```

Script `database.sql` akan membuat database, semua tabel, dan 4 akun demo.

**Langkah 4** — Atur izin folder upload:

```bash
chmod -R 755 uploads/
```

**Langkah 5** — Akses di browser:

```
http://localhost/VibeFlow
```

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
| GET | `/projects/edit/{id}` | Form edit proyek | PM (miliknya), Super Admin |
| POST | `/projects/edit/{id}` | Simpan perubahan proyek | PM (miliknya), Super Admin |
| GET | `/projects/delete/{id}` | Hapus proyek | PM (miliknya), Super Admin |
| POST | `/tasks/create` | Buat task baru | PM, Super Admin |
| POST | `/tasks/edit/{id}` | Edit task (title, priority, status, dll) | PM, Super Admin |
| GET | `/tasks/delete/{id}` | Hapus task & recalculate progress | PM, Super Admin |
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
| Buat / Edit / Hapus Proyek | ✅ | ✅ (miliknya) | ❌ | ❌ |
| Pilih Project Manager saat buat proyek | ✅ | ❌ | ❌ | ❌ |
| Buat / Edit / Hapus Tugas | ✅ | ✅ | ❌ | ❌ |
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
| Card | Glassmorphism (`bg-white/5 backdrop-blur-xl border border-white/5 rounded-[2rem]`) |
| Teks Utama | `text-slate-100` |
| Teks Sekunder | `text-slate-400` |
| Aksen Utama | Cyan (`#22d3ee`) |
| Sukses | Emerald (`#34d399`) |
| Peringatan | Yellow (`#facc15`) |
| Bahaya | Rose (`#fb7185`) |
| Font | Inter (Google Fonts) |

### Halaman yang Didesain Ulang

| Halaman | Perubahan |
|---------|----------|
| **Login** | Layout dua kolom, branding animasi VibeFlow di kiri, Lucide Icons, glassmorphism premium |
| **Project Detail** | Header inline dengan badge status, sidebar detail minimalis, kanban kolom terbuka (tanpa container) |
| **Kanban Board** | Kolom tanpa border container, kartu `rounded-2xl`, priority badge outline, avatar gradient |

### Open Graph Support

- `og:title`, `og:description`, `og:image` → tampil saat link dibagikan di WhatsApp, Telegram, dsb.
- `twitter:card` → pratinjau besar di Twitter/X.
- Gambar menggunakan `/assets/VibeFlow.svg`.

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

## 📝 Riwayat Perubahan

### v2.3 — Feature Release (Mei 2026)

#### ✨ Fitur Baru

| Komponen | Perubahan |
|----------|----------|
| `views/auth/login.php` | Redesain total: layout dua kolom, branding VibeFlow di kiri, Lucide Icons, glassmorphism premium |
| `models/ProjectModel.php` | Tambah method `updateProject()` dan `deleteProject()` untuk CRUD penuh |
| `models/TaskModel.php` | Tambah method `updateTask()` dan `deleteTask()` untuk CRUD penuh |
| `controllers/ProjectController.php` | Tambah action `edit`, `update`, `delete` dengan otorisasi role (PM miliknya / Super Admin) |
| `controllers/TaskController.php` | Tambah action `edit`, `delete` + recalculate progress proyek otomatis setelah perubahan |
| `views/projects/create.php` | Super Admin dapat memilih Project Manager & status proyek saat membuat proyek |
| `views/projects/edit.php` | Halaman edit proyek baru dengan konfirmasi hapus berbasis JavaScript |
| `views/projects/detail.php` | Redesain: header inline + badge status, sidebar detail minimalis dengan label all-caps |
| `views/projects/index.php` | Tambah ikon edit pada kartu proyek untuk PM dan Super Admin |
| `views/kanban/board.php` | Redesain papan Kanban: kolom terbuka, kartu `rounded-2xl`, tombol edit/hapus hover |
| `views/kanban/board.php` | Modal Edit Task baru: lengkap dengan tombol "Delete Task" di sudut kiri bawah modal |
| `views/layouts/header.php` | Tambah meta tag **Open Graph** (og:title, og:image, og:description) dan **Twitter Card** |

#### 🔌 Endpoint Baru

| Method | Endpoint | Aksi |
|--------|----------|------|
| GET | `/projects/edit/{id}` | Form edit proyek |
| POST | `/projects/edit/{id}` | Simpan perubahan proyek |
| GET | `/projects/delete/{id}` | Hapus proyek |
| POST | `/tasks/edit/{id}` | Edit data task |
| GET | `/tasks/delete/{id}` | Hapus task |

---

### v2.1 — Bug Fix Release (18 April 2026)

#### 🐛 Perbaikan Bug

| Komponen | Masalah | Solusi |
|----------|---------|--------|
| `DashboardController.php` | Statistik dashboard menampilkan `--` (tidak terhubung ke DB) | Menambahkan logika pengambilan data via `ProjectModel::getDashboardStats()` sebelum render view |
| `models/ProjectModel.php` | Tidak ada method untuk query statistik global | Menambahkan method `getDashboardStats()` dengan 3 query: total proyek, task aktif, dan deadline mendatang |
| `views/dashboard/pm.php` | Nilai statistik hardcoded sebagai teks statis `--` | Diganti dengan `<?= $stats['...'] ?>` untuk menampilkan data dinamis dari database |
| `assets/js/kanban.js` | Drag & drop Kanban tidak memperbarui status di DB | Diperbaiki logika fetch AJAX ke endpoint `/tasks/update_status` |
| `controllers/ReportController.php` | Tombol "View Report" tidak tersedia bagi Client | Tombol ditambahkan di halaman Detail Project |
| `helpers/auth_guard.php` | Log aktivitas tidak terekam pada beberapa aksi | Diperbaiki pemanggilan `log_activity()` yang terlewat |

#### ✅ Status Pengujian (Test Plan v2.1)

| Modul | Lulus | Gagal | Ditunda |
|-------|:-----:|:-----:|:-------:|
| Autentikasi & Sesi (TC-AUTH) | 6/6 | 0 | 0 |
| Manajemen Proyek (TC-PROJ) | 4/4 | 0 | 0 |
| Task Board & Kanban (TC-TASK) | 4/4 | 0 | 0 |
| Manajemen Dokumen (TC-DOC) | 4/4 | 0 | 0 |
| Pelaporan & Audit (TC-REP/AUD) | 3/3 | 0 | 0 |
| **Total** | **21/21** | **0** | **0** |

---

### v2.0 — MVP Development (April 2026)
- Rilis awal sistem VibeFlow dengan fitur RBAC, Kanban Board, Manajemen Dokumen, dan Laporan Proyek.

---

<div align="center">
  <sub>Dibangun dengan ❤️ oleh Tim VibeFlow · Mei 2026</sub>
</div>
