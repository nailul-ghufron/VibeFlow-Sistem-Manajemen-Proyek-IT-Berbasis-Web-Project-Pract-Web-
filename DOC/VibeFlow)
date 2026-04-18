1. Judul Sistem dan Sektor KBLI
Judul Sistem: Sistem Manajemen Proyek IT Berbasis Web (VibeFlow) Sektor KBLI:
Kelompok Pengembangan Perangkat Lunak & Konsultasi. Sistem ini secara spesifik merujuk
pada KBLI 2020 dengan kode 6201 (Aktivitas Pengembangan Perangkat Lunak) yang
mencakup kegiatan analisis, desain, dan pengodean sistem elektronik/perangkat lunak sesuai
pesanan klien.
2. Identifikasi Aktor (User Roles)
Sistem ini memiliki 4 (empat) aktor utama dengan hak akses yang berbeda, yaitu:
1. Super Admin: Memiliki hak akses penuh untuk mengelola master data, mengelola
seluruh akun pengguna, dan melakukan audit sistem.
2. Project Manager (PM): Bertanggung jawab membuat proyek baru, mengalokasikan
tugas, mengatur tenggat waktu (deadline), dan memonitor jalannya proyek secara
keseluruhan.
3. Programmer / Developer: Menerima detail tugas dari PM, mengerjakan tugas,
memperbarui status pengerjaan (To-do, In Progress, Done), dan mengunggah
dokumen/tautan hasil pekerjaan.
4. Klien (Client): Aktor eksternal yang dapat masuk ke dalam sistem untuk memantau
progres proyek mereka secara real-time, melihat laporan, dan memberikan
persetujuan (approval).
3. Kebutuhan Fungsional (Functional Requirements)
Kebutuhan fungsional merupakan fitur-fitur yang harus ada agar sistem dapat berjalan sesuai
tujuan bisnis:
1. Fitur Manajemen Autentikasi: Sistem harus menyediakan fitur login dan logout
berdasarkan peran (Role-Based Access) pengguna.
2. Fitur Manajemen Proyek (CRUD): Project Manager dapat menambah (Create),
melihat (Read), mengubah (Update), dan menghapus/mengarsipkan (Delete) data
proyek.
3. Fitur Task Board / Manajemen Tugas: Sistem harus menyediakan papan tugas
(Kanban style) di mana tugas dapat dipindahkan statusnya oleh programmer.
4. Fitur Manajemen Dokumen: Sistem harus memungkinkan pengguna untuk
mengunggah dan mengunduh file lampiran terkait proyek (seperti dokumen BRD,
Mockup, atau source code).
5. Fitur Kalkulasi Progres Otomatis: Sistem harus dapat menghitung dan
menampilkan persentase penyelesaian proyek secara otomatis berdasarkan jumlah
tugas yang berstatus "Done".
6. Fitur Pelaporan: Sistem harus dapat menghasilkan laporan ringkasan proyek untuk
dilihat atau diunduh oleh Klien.

4. Kebutuhan Non-Fungsional (Non-Functional
Requirements)
Kebutuhan non-fungsional memastikan sistem berjalan dengan baik, aman, dan efisien:
1. Keamanan (Security): Sistem harus mengenkripsi password pengguna (misalnya
dengan Bcrypt) dan memastikan klien A tidak dapat melihat data proyek klien B
(Isolasi Data).
2. Ketersediaan (Availability): Sistem harus berbasis web cloud sehingga dapat diakses
24/7 dari mana saja.
3. Performa (Performance): Waktu muat (load time) halaman dashboard maksimal 3
detik pada kondisi jaringan internet stabil.
4. Usability & Responsiveness: Antarmuka sistem harus mudah digunakan (User
Friendly) dan responsif, artinya tampilan harus dapat menyesuaikan diri saat dibuka
melalui PC, tablet, maupun smartphone.
5. Flowchart Bisnis Program
Berikut adalah alur proses bisnis sistem VibeFlow dari awal pembuatan proyek hingga
selesai.

Deskripsi Alur Bisnis:
[Terminator] Mulai.
[Input/Output] Pengguna (PM /
Programmer / Klien) memasukkan
Username dan Password pada halaman
Login.
[Decision] Sistem memvalidasi kredensial
login.
Jika Tidak Valid, kembali ke halaman
Login.
Jika Valid, masuk ke Dashboard sesuai
Role.
[Process] Project Manager membuat
Proyek Baru dan membagi Tugas (Task).
[Database/Data] Sistem menyimpan data
proyek dan tugas ke dalam Database.
[Process] Programmer menerima tugas,
mengerjakannya, dan mengubah status
tugas menjadi "Selesai" (Done).
[Process] Sistem secara otomatis
menghitung ulang persentase progres
proyek.
[Decision] Apakah seluruh tugas dalam
proyek sudah 100% selesai?
Jika Belum, kembali ke proses pengerjaan
oleh Programmer (Langkah 6).
Jika Ya, lanjut ke pembuatan laporan.
[Document] Sistem men-generate Laporan
Hasil Proyek (Berupa Dokumen
PDF/Tampilan Laporan Akhir).
[Input/Output] Klien melihat laporan dan
memberikan persetujuan (Approval).
[Terminator] Selesai.

1. Teknologi (Tech Stack)
Berdasarkan arsitektur yang sudah Anda tetapkan, ini adalah rangkuman tumpukan teknologi murni (vanilla) yang akan kita gunakan untuk membangun sistem:

Frontend Framework: HTML5 murni dan Tailwind CSS (via CDN untuk vibecoding cepat) guna menciptakan efek dark mode dan glassmorphism.

Interaktivitas (Client-Side): Vanilla JavaScript (ES6+). Fokus pada HTML5 Drag and Drop API untuk Kanban, dan Fetch API untuk pengiriman data asinkron (AJAX).

Backend Logic: PHP murni. Menangani sesi login, logika otorisasi peran (Super Admin, PM, Programmer, Klien), dan pemrosesan file unggahan.

Manajemen Database: MySQL yang dihubungkan melalui ekstensi PHP PDO (PHP Data Objects) menggunakan Prepared Statements untuk keamanan mutlak terhadap SQL Injection.

2. Struktur Database (Tabel & Kolom)
Berikut adalah rancangan skema database relasional (vibeflow_db) yang efisien dan langsung bisa Anda terjemahkan ke phpMyAdmin:

Tabel users (Penyimpanan Akun Aktor)

id (INT, Primary Key, Auto Increment)

name (VARCHAR 100)

email (VARCHAR 100, Unique)

password (VARCHAR 255) -> Untuk menyimpan hasil password_hash()

role (ENUM: 'super_admin', 'pm', 'programmer', 'client')

created_at (DATETIME)

Tabel projects (Manajemen Proyek Klien)

id (INT, Primary Key, Auto Increment)

title (VARCHAR 150)

description (TEXT)

client_id (INT, Foreign Key ke users.id)

pm_id (INT, Foreign Key ke users.id)

status (ENUM: 'planning', 'active', 'completed')

deadline (DATE)

created_at (DATETIME)

Tabel tasks (Papan Kanban)

id (INT, Primary Key, Auto Increment)

project_id (INT, Foreign Key ke projects.id)

programmer_id (INT, Foreign Key ke users.id) -> Siapa yang mengerjakan

title (VARCHAR 150)

status (ENUM: 'todo', 'in_progress', 'done') -> Untuk filter kolom drag-and-drop

updated_at (DATETIME) -> Berubah otomatis saat kartu digeser di Kanban

Tabel documents (Penyimpanan Berkas)

id (INT, Primary Key, Auto Increment)

project_id (INT, Foreign Key ke projects.id)

uploader_id (INT, Foreign Key ke users.id)

file_name (VARCHAR 255) -> Nama asli file

file_path (VARCHAR 255) -> Lokasi folder di server lokal, misal: /uploads/docs/...

uploaded_at (DATETIME)

3. Desain Visual (Mockup UI/UX Elite Developer)
Untuk mencapai estetika antarmuka premium, rapi, dan modern, kita akan menggunakan konsep tata letak Bento Grid dipadukan dengan efek Glassmorphism. Berikut adalah deskripsi tata letak halamannya:

Tema Global:

Background: Warna gelap solid, misalnya bg-slate-900 atau bg-[#0f172a].

Elemen Kartu (Card): Latar belakang semi-transparan dengan efek blur. Di Tailwind, Anda akan sering menggunakan class: bg-white/5 backdrop-blur-md border border-white/10.

Aksen Warna: Menggunakan warna neon yang subtil (seperti Cyan atau Emerald) untuk indikator progres dan tombol utama.

Tata Letak Halaman Dasbor Utama (View Programmer & PM):

Bilah Samping Kiri (Sidebar Navigation):

Lebar sekitar 250px, menempel di kiri layar.

Menampilkan logo VibeFlow bercahaya di atas.

Menu navigasi vertikal: Dasbor, Proyek Saya, Kanban Board, Dokumen, Pengaturan.

Tombol "Logout" dengan aksen merah redup di bagian paling bawah.

Bilah Atas (Top Header):

Baris pencarian (Search Bar) bergaya pil di tengah.

Profil pengguna di kanan atas (Avatar bundar dan nama Role).

Area Konten Utama (Bento Grid Style):

Kartu Atas (Header Card): Menyapa pengguna (misal: "Welcome back, Developer") dengan angka ringkasan (Total Tugas Selesai, Tugas Tertunda).

Kartu Papan Kanban (Lebar Penuh): Dibagi menjadi tiga kolom vertikal secara sejajar:

Kolom "To Do": Daftar tugas yang siap ditarik.

Kolom "In Progress": Tugas yang sedang dikerjakan (diberi aksen pinggiran warna kuning/oranye).

Kolom "Done": Tugas selesai (diberi aksen pinggiran hijau).

Interaksi: Kursor akan berubah menjadi grab saat diarahkan ke kartu tugas. Kartu bisa ditarik dan dilepas antar kolom dengan animasi transisi yang mulus.