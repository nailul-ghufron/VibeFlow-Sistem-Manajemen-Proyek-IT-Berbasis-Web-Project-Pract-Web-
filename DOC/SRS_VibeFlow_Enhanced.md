# Software Requirements Specification (SRS)
# VibeFlow — Sistem Manajemen Proyek IT Berbasis Web

> **Versi Dokumen:** 2.0  
> **Tanggal:** April 2026  
> **Status:** Final Draft  
> **Disusun oleh:** Tim Pengembang VibeFlow

---

## Daftar Isi

1. Judul Sistem dan Sektor KBLI
2. Identifikasi Aktor (User Roles)
3. Kebutuhan Fungsional (Functional Requirements)
4. Kebutuhan Non-Fungsional (Non-Functional Requirements)
5. Flowchart Bisnis Program
6. Tech Stack & Arsitektur Sistem
7. Struktur Database
8. Desain Visual (Mockup UI/UX)
9. Arsitektur Folder & Konvensi Penamaan File
10. Spesifikasi API Endpoint (Backend Routes)
11. Matriks Hak Akses (Authorization Matrix)
12. Alur Keamanan & Validasi
13. Rencana Pengujian (Test Plan)
14. Glosarium

---

## 1. Judul Sistem dan Sektor KBLI

**Judul Sistem:** Sistem Manajemen Proyek IT Berbasis Web (VibeFlow)

**Sektor KBLI:** Kelompok Pengembangan Perangkat Lunak & Konsultasi. Sistem ini secara spesifik merujuk pada KBLI 2020 dengan kode **6201** (Aktivitas Pengembangan Perangkat Lunak) yang mencakup kegiatan analisis, desain, dan pengodean sistem elektronik/perangkat lunak sesuai pesanan klien.

---

## 2. Identifikasi Aktor (User Roles)

Sistem ini memiliki **4 (empat) aktor utama** dengan hak akses yang berbeda, yaitu:

1. **Super Admin:** Memiliki hak akses penuh untuk mengelola master data, mengelola seluruh akun pengguna, dan melakukan audit sistem.
2. **Project Manager (PM):** Bertanggung jawab membuat proyek baru, mengalokasikan tugas, mengatur tenggat waktu (deadline), dan memonitor jalannya proyek secara keseluruhan.
3. **Programmer / Developer:** Menerima detail tugas dari PM, mengerjakan tugas, memperbarui status pengerjaan (To-do, In Progress, Done), dan mengunggah dokumen/tautan hasil pekerjaan.
4. **Klien (Client):** Aktor eksternal yang dapat masuk ke dalam sistem untuk memantau progres proyek mereka secara real-time, melihat laporan, dan memberikan persetujuan (approval).

---

## 3. Kebutuhan Fungsional (Functional Requirements)

Kebutuhan fungsional merupakan fitur-fitur yang harus ada agar sistem dapat berjalan sesuai tujuan bisnis:

1. **Fitur Manajemen Autentikasi:** Sistem harus menyediakan fitur login dan logout berdasarkan peran (Role-Based Access) pengguna.
2. **Fitur Manajemen Proyek (CRUD):** Project Manager dapat menambah (Create), melihat (Read), mengubah (Update), dan menghapus/mengarsipkan (Delete) data proyek.
3. **Fitur Task Board / Manajemen Tugas:** Sistem harus menyediakan papan tugas (Kanban style) di mana tugas dapat dipindahkan statusnya oleh programmer.
4. **Fitur Manajemen Dokumen:** Sistem harus memungkinkan pengguna untuk mengunggah dan mengunduh file lampiran terkait proyek (seperti dokumen BRD, Mockup, atau source code).
5. **Fitur Kalkulasi Progres Otomatis:** Sistem harus dapat menghitung dan menampilkan persentase penyelesaian proyek secara otomatis berdasarkan jumlah tugas yang berstatus "Done".
6. **Fitur Pelaporan:** Sistem harus dapat menghasilkan laporan ringkasan proyek untuk dilihat atau diunduh oleh Klien.

---

## 4. Kebutuhan Non-Fungsional (Non-Functional Requirements)

Kebutuhan non-fungsional memastikan sistem berjalan dengan baik, aman, dan efisien:

1. **Keamanan (Security):** Sistem harus mengenkripsi password pengguna (misalnya dengan Bcrypt) dan memastikan klien A tidak dapat melihat data proyek klien B (Isolasi Data).
2. **Ketersediaan (Availability):** Sistem harus berbasis web cloud sehingga dapat diakses 24/7 dari mana saja.
3. **Performa (Performance):** Waktu muat (load time) halaman dashboard maksimal 3 detik pada kondisi jaringan internet stabil.
4. **Usability & Responsiveness:** Antarmuka sistem harus mudah digunakan (User Friendly) dan responsif, artinya tampilan harus dapat menyesuaikan diri saat dibuka melalui PC, tablet, maupun smartphone.

---

## 5. Flowchart Bisnis Program

Berikut adalah alur proses bisnis sistem VibeFlow dari awal pembuatan proyek hingga selesai.

**Deskripsi Alur Bisnis:**

| # | Simbol | Keterangan |
|---|--------|------------|
| 1 | [Terminator] | Mulai |
| 2 | [Input/Output] | Pengguna (PM / Programmer / Klien) memasukkan Username dan Password pada halaman Login |
| 3 | [Decision] | Sistem memvalidasi kredensial login |
| — | | Jika **Tidak Valid** → kembali ke halaman Login |
| — | | Jika **Valid** → masuk ke Dashboard sesuai Role |
| 4 | [Process] | Project Manager membuat Proyek Baru dan membagi Tugas (Task) |
| 5 | [Database] | Sistem menyimpan data proyek dan tugas ke dalam Database |
| 6 | [Process] | Programmer menerima tugas, mengerjakannya, dan mengubah status tugas menjadi "Done" |
| 7 | [Process] | Sistem secara otomatis menghitung ulang persentase progres proyek |
| 8 | [Decision] | Apakah seluruh tugas dalam proyek sudah 100% selesai? |
| — | | Jika **Belum** → kembali ke proses pengerjaan Programmer (Langkah 6) |
| — | | Jika **Ya** → lanjut ke pembuatan laporan |
| 9 | [Document] | Sistem men-generate Laporan Hasil Proyek (PDF / Tampilan Laporan Akhir) |
| 10 | [Input/Output] | Klien melihat laporan dan memberikan persetujuan (Approval) |
| 11 | [Terminator] | Selesai |

---

## 6. Tech Stack & Arsitektur Sistem

> *Poin ini merupakan penyempurnaan dan formalisasi dari spesifikasi teknologi yang telah ditetapkan sebelumnya.*

### 6.1 Tumpukan Teknologi (Tech Stack)

| Layer | Teknologi | Keterangan |
|-------|-----------|------------|
| **Frontend** | HTML5 + Tailwind CSS (CDN) | Markup semantik & utility-first styling |
| **Interaktivitas** | Vanilla JavaScript (ES6+) | Drag & Drop API untuk Kanban, Fetch API untuk AJAX |
| **Backend** | PHP 8.x (Pure/Vanilla) | Logika bisnis, sesi, otorisasi berbasis peran |
| **Database** | MySQL 8.x | Relational DBMS via PHP PDO + Prepared Statements |
| **Server Lokal** | XAMPP / Laragon | Environment pengembangan lokal |

### 6.2 Diagram Arsitektur Sistem (MVC-like Pattern)

Meski menggunakan PHP murni, kode akan diorganisir mengikuti pola **MVC sederhana** untuk keterbacaan dan pemeliharaan:

```
[Browser/Client]
      │  HTTP Request
      ▼
[index.php / Router sederhana]
      │
      ├──► [Controller] ──► [Model (PDO Query)] ──► [MySQL DB]
      │                          │
      └──► [View (HTML Template)] ◄──────────────────┘
                 │
           Tailwind CSS + JS
```

- **Controller:** File PHP yang memproses logika (mis. `ProjectController.php`)
- **Model:** File PHP berisi fungsi-fungsi query database (mis. `ProjectModel.php`)
- **View:** File HTML/PHP sebagai template tampilan (mis. `dashboard.php`)

### 6.3 Lingkungan Pengembangan (Development Environment)

| Kebutuhan | Versi Minimum |
|-----------|---------------|
| PHP | 8.1 |
| MySQL | 8.0 |
| Browser Target | Chrome 110+, Firefox 110+, Edge 110+ |
| Resolusi Minimum | 360px (Mobile) |

---

## 7. Struktur Database

> *Poin ini merupakan penyempurnaan dari skema database yang telah dirancang, dengan penambahan constraint, index, dan tabel tambahan yang diperlukan.*

**Nama Database:** `vibeflow_db`

### 7.1 Tabel `users`

| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identitas unik pengguna |
| `name` | VARCHAR(100) | NOT NULL | Nama lengkap |
| `email` | VARCHAR(100) | UNIQUE, NOT NULL | Email untuk login |
| `password` | VARCHAR(255) | NOT NULL | Hash hasil `password_hash()` (Bcrypt) |
| `role` | ENUM | NOT NULL | `'super_admin'`, `'pm'`, `'programmer'`, `'client'` |
| `avatar` | VARCHAR(255) | NULL | Path foto profil pengguna (opsional) |
| `is_active` | TINYINT(1) | DEFAULT 1 | Soft-disable akun tanpa hapus data |
| `created_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Waktu registrasi |
| `last_login` | DATETIME | NULL | Waktu login terakhir |

### 7.2 Tabel `projects`

| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identitas unik proyek |
| `title` | VARCHAR(150) | NOT NULL | Nama proyek |
| `description` | TEXT | NULL | Deskripsi detail proyek |
| `client_id` | INT | FK → `users.id` | Klien pemilik proyek |
| `pm_id` | INT | FK → `users.id` | PM yang mengelola proyek |
| `status` | ENUM | DEFAULT `'planning'` | `'planning'`, `'active'`, `'completed'`, `'archived'` |
| `deadline` | DATE | NOT NULL | Tenggat waktu proyek |
| `progress` | TINYINT | DEFAULT 0 | Persentase progres (0–100), di-update otomatis via trigger/query |
| `created_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Waktu proyek dibuat |
| `updated_at` | DATETIME | ON UPDATE CURRENT_TIMESTAMP | Waktu perubahan terakhir |

**Index:** `INDEX idx_client_id (client_id)`, `INDEX idx_pm_id (pm_id)`

### 7.3 Tabel `tasks`

| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identitas unik tugas |
| `project_id` | INT | FK → `projects.id` ON DELETE CASCADE | Proyek induk |
| `programmer_id` | INT | FK → `users.id` | Developer yang ditugaskan |
| `title` | VARCHAR(150) | NOT NULL | Judul tugas |
| `description` | TEXT | NULL | Detail tugas (opsional) |
| `priority` | ENUM | DEFAULT `'medium'` | `'low'`, `'medium'`, `'high'` |
| `status` | ENUM | DEFAULT `'todo'` | `'todo'`, `'in_progress'`, `'done'` |
| `due_date` | DATE | NULL | Tenggat tugas spesifik |
| `created_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Waktu tugas dibuat |
| `updated_at` | DATETIME | ON UPDATE CURRENT_TIMESTAMP | Berubah otomatis saat kartu digeser di Kanban |

**Index:** `INDEX idx_project_id (project_id)`, `INDEX idx_programmer_id (programmer_id)`

### 7.4 Tabel `documents`

| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identitas unik dokumen |
| `project_id` | INT | FK → `projects.id` ON DELETE CASCADE | Proyek terkait |
| `uploader_id` | INT | FK → `users.id` | Pengguna yang mengunggah |
| `file_name` | VARCHAR(255) | NOT NULL | Nama asli file |
| `file_path` | VARCHAR(255) | NOT NULL | Lokasi file di server: `/uploads/docs/{project_id}/...` |
| `file_size` | INT | NULL | Ukuran file dalam bytes |
| `file_type` | VARCHAR(50) | NULL | MIME type (mis. `application/pdf`) |
| `uploaded_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Waktu unggah |

### 7.5 Tabel `activity_logs` *(Tabel Tambahan)*

Tabel ini mendukung fitur **Audit Trail** yang dibutuhkan oleh Super Admin.

| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | ID log |
| `user_id` | INT | FK → `users.id` | Siapa yang melakukan aksi |
| `action` | VARCHAR(100) | NOT NULL | Deskripsi aksi (mis. `'UPDATE_TASK_STATUS'`) |
| `target_table` | VARCHAR(50) | NOT NULL | Tabel yang terpengaruh |
| `target_id` | INT | NOT NULL | ID record yang terpengaruh |
| `old_value` | TEXT | NULL | Nilai sebelum perubahan (JSON) |
| `new_value` | TEXT | NULL | Nilai setelah perubahan (JSON) |
| `ip_address` | VARCHAR(45) | NULL | IP pengguna |
| `created_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Waktu kejadian |

### 7.6 Entity Relationship Diagram (ERD) — Teks

```
users ──(1)──────────────(N)── projects (sebagai client_id)
users ──(1)──────────────(N)── projects (sebagai pm_id)
users ──(1)──────────────(N)── tasks (sebagai programmer_id)
users ──(1)──────────────(N)── documents (sebagai uploader_id)
users ──(1)──────────────(N)── activity_logs

projects ──(1)──────────(N)── tasks
projects ──(1)──────────(N)── documents
```

---

## 8. Desain Visual (Mockup UI/UX)

> *Poin ini merupakan penyempurnaan dari konsep desain yang telah ditetapkan, dengan spesifikasi komponen yang lebih terperinci.*

### 8.1 Tema Global

| Properti | Nilai / Kelas Tailwind |
|----------|------------------------|
| Background | `bg-[#0f172a]` (Slate 900) |
| Card Background | `bg-white/5 backdrop-blur-md border border-white/10` |
| Warna Teks Utama | `text-slate-100` |
| Warna Teks Sekunder | `text-slate-400` |
| Aksen Utama (Cyan) | `text-cyan-400`, `border-cyan-400/50` |
| Aksen Sukses (Hijau) | `text-emerald-400` |
| Aksen Peringatan (Kuning) | `text-yellow-400` |
| Aksen Bahaya (Merah) | `text-rose-400` |
| Font | Inter / System-UI |

### 8.2 Layout Halaman Dashboard

```
┌───────────────────────────────────────────────────────────┐
│  SIDEBAR (250px fixed)   │         MAIN CONTENT           │
│  ┌──────────────────┐    │  ┌─────────────────────────┐   │
│  │  VibeFlow Logo   │    │  │  TOP HEADER BAR         │   │
│  ├──────────────────┤    │  │  [Search]  [Avatar/Role]│   │
│  │  > Dashboard     │    │  └─────────────────────────┘   │
│  │  > My Projects   │    │                                 │
│  │  > Kanban Board  │    │  ┌─────────────────────────┐   │
│  │  > Documents     │    │  │  WELCOME CARD           │   │
│  │  > Settings      │    │  │  "Hi, [Name]" + Stats   │   │
│  ├──────────────────┤    │  └─────────────────────────┘   │
│  │  [Logout]        │    │                                 │
│  └──────────────────┘    │  ┌────┬────┬────────────────┐  │
│                           │  │TODO│ IP │      DONE      │  │
│                           │  │    │    │                │  │
│                           │  │    │    │                │  │
│                           │  └────┴────┴────────────────┘  │
└───────────────────────────────────────────────────────────┘
```

### 8.3 Spesifikasi Komponen UI

#### Sidebar Navigation
- Lebar tetap 250px, `position: fixed`, tinggi 100vh
- Logo VibeFlow dengan efek glow `text-shadow: 0 0 10px cyan`
- Menu aktif ditandai dengan `border-l-2 border-cyan-400 bg-white/10`
- Tombol Logout di bawah dengan warna `text-rose-400`

#### Kanban Board
- Tiga kolom sejajar: **To Do** | **In Progress** | **Done**
- Setiap kolom: `min-height: 400px`, scrollable secara vertikal
- Indikator warna kolom: Abu-abu | Kuning-Oranye | Hijau Emerald
- Kartu tugas: menampilkan `title`, `programmer avatar`, `priority badge`, dan `due_date`
- Interaksi Drag & Drop: kursor berubah menjadi `grab`, animasi `opacity: 0.5` saat sedang ditarik, dan highlight `border-dashed` pada kolom target

#### Progress Bar Proyek
- Komponen visual bar horizontal dengan persentase
- Warna: `< 30%` → merah, `30–70%` → kuning, `> 70%` → hijau
- Teks persentase ditampilkan di dalam atau di samping bar

#### Halaman Login
- Layout terpusat (center screen), lebar maksimal 400px
- Card dengan efek glassmorphism di atas background gelap
- Validasi error ditampilkan secara inline di bawah setiap field

---

## 9. Arsitektur Folder & Konvensi Penamaan File

Struktur direktori proyek yang rapi adalah fondasi dari kode yang mudah dipelihara.

```
vibeflow/
├── config/
│   └── database.php          # Koneksi PDO
├── controllers/
│   ├── AuthController.php    # Login, logout, session
│   ├── ProjectController.php # CRUD proyek
│   ├── TaskController.php    # CRUD tugas & update status Kanban
│   └── DocumentController.php # Upload & download file
├── models/
│   ├── UserModel.php
│   ├── ProjectModel.php
│   ├── TaskModel.php
│   └── DocumentModel.php
├── views/
│   ├── auth/
│   │   └── login.php
│   ├── layouts/
│   │   ├── sidebar.php       # Komponen sidebar (di-include)
│   │   └── header.php        # Komponen header atas
│   ├── dashboard/
│   │   ├── pm.php
│   │   ├── programmer.php
│   │   └── client.php
│   ├── projects/
│   │   ├── index.php
│   │   ├── create.php
│   │   └── detail.php
│   ├── kanban/
│   │   └── board.php
│   └── reports/
│       └── project_report.php
├── assets/
│   ├── js/
│   │   ├── kanban.js         # Logika Drag & Drop
│   │   └── main.js           # Skrip global
│   └── css/
│       └── custom.css        # Override Tailwind minimal
├── uploads/
│   └── docs/
│       └── {project_id}/     # File diorganisir per proyek
├── helpers/
│   └── auth_guard.php        # Fungsi cek sesi & otorisasi
├── index.php                 # Entry point & router sederhana
└── .htaccess                 # Redirect semua request ke index.php
```

**Konvensi Penamaan:**
- File PHP: `PascalCase` untuk class, `snake_case` untuk view
- Variabel PHP: `$camelCase`
- Kolom Database: `snake_case`
- File JavaScript: `camelCase.js`

---

## 10. Spesifikasi API Endpoint (Backend Routes)

Meskipun menggunakan PHP murni, seluruh operasi data dari JavaScript (AJAX/Fetch) diarahkan ke endpoint terstruktur. Endpoint ini menggunakan query string atau path routing sederhana via `index.php`.

### 10.1 Autentikasi

| Method | URL | Aksi | Role |
|--------|-----|------|------|
| POST | `/auth/login` | Proses login, buat sesi | Semua |
| GET | `/auth/logout` | Hapus sesi, redirect login | Semua |

### 10.2 Proyek

| Method | URL | Aksi | Role |
|--------|-----|------|------|
| GET | `/projects` | Tampilkan daftar proyek | PM, Super Admin |
| GET | `/projects/detail?id={id}` | Detail satu proyek | PM, Client, Programmer |
| POST | `/projects/create` | Buat proyek baru | PM |
| POST | `/projects/update?id={id}` | Update data proyek | PM |
| POST | `/projects/archive?id={id}` | Arsipkan proyek | PM, Super Admin |

### 10.3 Tugas (Kanban)

| Method | URL | Aksi | Role |
|--------|-----|------|------|
| GET | `/tasks?project_id={id}` | Ambil semua tugas proyek | PM, Programmer |
| POST | `/tasks/create` | Tambah tugas baru | PM |
| POST | `/tasks/update-status` | Update status tugas (drag & drop) | Programmer |
| POST | `/tasks/update?id={id}` | Edit detail tugas | PM |
| POST | `/tasks/delete?id={id}` | Hapus tugas | PM |

> **Catatan:** Endpoint `update-status` menerima body JSON: `{"task_id": X, "new_status": "in_progress"}` dan mengembalikan JSON dengan persentase progres proyek yang diperbarui.

### 10.4 Dokumen

| Method | URL | Aksi | Role |
|--------|-----|------|------|
| POST | `/documents/upload` | Upload file ke server | PM, Programmer |
| GET | `/documents/download?id={id}` | Download file | Semua (sesuai proyek) |
| POST | `/documents/delete?id={id}` | Hapus file | PM, Super Admin |

### 10.5 Laporan

| Method | URL | Aksi | Role |
|--------|-----|------|------|
| GET | `/reports/project?id={id}` | Tampilkan laporan proyek | PM, Client |
| GET | `/reports/export?id={id}` | Export laporan ke PDF | PM, Client |

---

## 11. Matriks Hak Akses (Authorization Matrix)

Tabel ini merangkum secara eksplisit apa yang dapat dilakukan setiap aktor pada setiap fitur sistem.

| Fitur | Super Admin | Project Manager | Programmer | Client |
|-------|:-----------:|:---------------:|:----------:|:------:|
| Kelola Akun Pengguna | ✅ | ❌ | ❌ | ❌ |
| Lihat Semua Proyek | ✅ | ✅ (hanya miliknya) | ✅ (hanya ditugaskan) | ✅ (hanya miliknya) |
| Buat / Edit / Arsip Proyek | ✅ | ✅ | ❌ | ❌ |
| Buat / Edit / Hapus Tugas | ✅ | ✅ | ❌ | ❌ |
| Update Status Tugas (Kanban) | ✅ | ✅ | ✅ | ❌ |
| Upload Dokumen | ✅ | ✅ | ✅ | ❌ |
| Download Dokumen | ✅ | ✅ | ✅ | ✅ |
| Lihat & Setujui Laporan | ✅ | ✅ | ❌ | ✅ |
| Export Laporan PDF | ✅ | ✅ | ❌ | ✅ |
| Lihat Activity Log / Audit | ✅ | ❌ | ❌ | ❌ |

---

## 12. Alur Keamanan & Validasi

### 12.1 Autentikasi & Sesi

- Sesi PHP dimulai dengan `session_start()` dan dikonfigurasi dengan `session.cookie_httponly = 1` dan `session.cookie_samesite = "Strict"` untuk mencegah serangan XSS dan CSRF.
- Setiap halaman yang memerlukan login wajib memanggil `auth_guard.php` di baris pertama.
- Token CSRF sederhana ditambahkan pada setiap form POST menggunakan hidden field.

### 12.2 Validasi Input

| Sumber Input | Mekanisme Perlindungan |
|---|---|
| Form data | `htmlspecialchars()`, filter_input(), validasi tipe data |
| Query Database | **PDO Prepared Statements** (mutlak, tanpa pengecualian) |
| File Upload | Validasi ekstensi whitelist, validasi MIME type, batas ukuran 10MB |
| Output ke HTML | `htmlspecialchars()` pada semua data dari database |

### 12.3 Isolasi Data Klien

- Setiap query yang melibatkan data klien **wajib** menyertakan kondisi `WHERE client_id = $_SESSION['user_id']`.
- PM hanya dapat melihat proyek yang `pm_id`-nya sesuai dengan sesi aktif.
- Programmer hanya dapat mengakses tugas yang `programmer_id`-nya sesuai dengan sesi aktif.

### 12.4 Keamanan File Upload

```
Alur Upload File:
1. Validasi ekstensi → Whitelist: [pdf, doc, docx, png, jpg, zip, rar]
2. Validasi MIME type via finfo_file() (bukan dari $_FILES['type'])
3. Generate nama file baru: uniqid() + hash pendek (hindari traversal path)
4. Simpan ke direktori di luar web root ATAU gunakan .htaccess deny all
5. Akses file hanya via controller download (bukan akses langsung URL)
```

---

## 13. Rencana Pengujian (Test Plan)

### 13.1 Unit Testing — Fungsi Kritis

| ID Test | Fungsi yang Diuji | Input | Expected Output |
|---------|-------------------|-------|-----------------|
| TC-001 | Login dengan kredensial valid | Email & password benar | Redirect ke dashboard sesuai role |
| TC-002 | Login dengan password salah | Email benar, password salah | Pesan error "Kredensial tidak valid" |
| TC-003 | Kalkulasi progres proyek | 3 dari 5 tugas = "done" | Progres = 60% |
| TC-004 | Upload file ekstensi terlarang | File `.exe` | Ditolak dengan pesan error |
| TC-005 | Drag & drop tugas ke kolom "Done" | Task berpindah | Status di DB berubah, progres di-recalculate |
| TC-006 | Klien A akses proyek Klien B | URL manipulation | Redirect/403 Forbidden |
| TC-007 | Buat proyek tanpa deadline | Form kosong pada field deadline | Validasi error, data tidak disimpan |

### 13.2 User Acceptance Testing (UAT)

Pengujian penerimaan pengguna dilakukan bersama stakeholder (minimal PM dan Klien representatif) dengan skenario:

1. **Skenario Lengkap:** Dari login PM → buat proyek → assign tugas → programmer update status → klien lihat laporan → klien approval.
2. **Skenario Responsivitas:** Akses sistem dari perangkat mobile (smartphone) dan pastikan semua fitur dapat dioperasikan.
3. **Skenario Performa:** Akses dashboard dengan ≥ 10 proyek aktif dan ≥ 50 tugas; ukur load time (target ≤ 3 detik).

---

## 14. Glosarium

| Istilah | Definisi |
|---------|----------|
| **SRS** | Software Requirements Specification — dokumen yang mendefinisikan kebutuhan sistem perangkat lunak secara lengkap |
| **KBLI** | Klasifikasi Baku Lapangan Usaha Indonesia — standar klasifikasi jenis usaha dari BPS |
| **CRUD** | Create, Read, Update, Delete — operasi dasar pada data |
| **Kanban** | Metode manajemen tugas visual menggunakan papan dengan kolom status |
| **PDO** | PHP Data Objects — ekstensi PHP untuk akses database yang aman |
| **Prepared Statement** | Teknik query database yang memisahkan perintah SQL dari data untuk mencegah SQL Injection |
| **MIME Type** | Multipurpose Internet Mail Extensions — tipe data standar yang mengidentifikasi format file |
| **Glassmorphism** | Gaya desain UI dengan efek kaca buram (background blur + transparansi) |
| **Bento Grid** | Tata letak UI modern terinspirasi dari kotak bento Jepang — grid asimetris yang rapi |
| **Role-Based Access Control (RBAC)** | Sistem otorisasi yang memberikan hak akses berdasarkan peran pengguna |
| **CSRF** | Cross-Site Request Forgery — jenis serangan yang memaksa pengguna menjalankan aksi tidak diinginkan |
| **XSS** | Cross-Site Scripting — jenis serangan injeksi skrip ke dalam halaman web |
| **Audit Trail** | Catatan kronologis aktivitas pengguna dalam sistem untuk keperluan pemantauan dan keamanan |
| **UAT** | User Acceptance Testing — fase pengujian akhir bersama pengguna nyata |
| **Foreign Key (FK)** | Kolom database yang merujuk ke primary key tabel lain untuk menjaga integritas relasional |

---

*Dokumen SRS ini bersifat living document dan dapat diperbarui seiring perkembangan proyek. Setiap perubahan signifikan harus disetujui oleh Project Manager dan dicatat dalam riwayat revisi.*
