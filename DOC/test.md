# VibeFlow — Panduan & Rencana Pengujian (Test Plan)

Dokumen ini berisi checklist pengujian untuk memastikan sistem **VibeFlow** berjalan sesuai dengan spesifikasi yang telah ditetapkan dalam SRS.

---

## 1. Skenario Pengujian: Autentikasi & Sesi
Fokus: Memastikan sistem keamanan login dan pembatasan akses dasar.

| ID | Kasus Uji | Langkah | Hasil yang Diharapkan | Status |
|----|-----------|---------|-----------------------|--------|
| TC-AUTH-01 | Login Valid (PM) | Input `pm@vibeflow.com` / `password123` | Masuk ke Dashboard PM | [✅ ] |
| TC-AUTH-02 | Login Valid (Dev) | Input `dev@vibeflow.com` / `password123` | Masuk ke Dashboard Programmer | [ ✅] |
| TC-AUTH-03 | Login Valid (Client) | Input `client@vibeflow.com` / `password123` | Masuk ke Dashboard Client | [✅ ] |
| TC-AUTH-04 | Password Salah | Input email benar, password salah | Muncul pesan "Invalid credentials" | [ ✅] |
| TC-AUTH-05 | Akses Tanpa Login | Buka langsung `http://localhost:8000/projects` | Dialihkan (redirect) ke halaman Login | [ ✅] |
| TC-AUTH-06 | Logout | Klik tombol Logout di sidebar | Sesi berakhir, kembali ke halaman Login | [ ✅] |

---

## 2. Skenario Pengujian: Manajemen Proyek (Role: PM / Admin)
Fokus: Alur pembuatan dan pemantauan proyek.

| ID | Kasus Uji | Langkah | Hasil yang Diharapkan | Status |
|----|-----------|---------|-----------------------|--------|
| TC-PROJ-01 | Buat Proyek Baru | Isi form Create Project dengan lengkap | Proyek muncul di daftar; dialihkan ke list | [ ✅] |
| TC-PROJ-02 | Validasi Form Kosong | Klik "Create" dengan field kosong | Muncul pesan error "Title and Deadline are required" | [✅ ] |
| TC-PROJ-03 | Detail Proyek | Klik "Details" pada salah satu proyek | Masuk ke halaman detail proyek | [ ✅] |
| TC-PROJ-04 | Filter Proyek (Isolasi) | Login sebagai PM A | Tidak bisa melihat proyek milik PM B | [ ✅] |

---

## 3. Skenario Pengujian: Task Board & Kanban (Role: PM / Dev)
Fokus: Interaktivitas papan tugas dan perhitungan progres.

| ID | Kasus Uji | Langkah | Hasil yang Diharapkan | Status |
|----|-----------|---------|-----------------------|--------|
| TC-TASK-01 | Tambah Task (PM) | Klik "+ Add Task" di detail proyek | Task baru muncul di kolom "To Do" | [✅ ] |
<<<<<<< HEAD
| TC-TASK-02 | Drag & Drop (Dev) | Geser task dari "To Do" ke "In Progress" | Kartu berpindah; status di DB terupdate | [ ✅ FIXED (Silakan re-test)] | 
| TC-TASK-03 | Drag & Drop (Dev) | Geser task ke kolom "Done" | Kartu berpindah; progres proyek di sidebar naik | [✅ FIXED (Silakan re-test)] |
| TC-TASK-04 | Update Progres Otomatis | Selesaikan 1 dari 2 task (50%) | Progress bar di sidebar menunjukkan 50% | [✅ FIXED (Silakan re-test)] |
=======


## 4. Skenario Pengujian: Manajemen Dokumen
Fokus: Keamanan file dan validasi upload.

| ID | Kasus Uji | Langkah | Hasil yang Diharapkan | Status |
|----|-----------|---------|-----------------------|--------|
| TC-DOC-01 | Upload PDF/Image | Pilih file .pdf atau .png (< 10MB) | File berhasil terunggah dan muncul di list | [✅ ] |
| TC-DOC-02 | Upload File Terlarang | Pilih file .exe atau .php | Ditolak dengan pesan error ekstensi | [✅ ] |
| TC-DOC-03 | Upload File Raksasa | Pilih file > 10MB | Ditolak dengan pesan "File too large" | [ ✅] |
| TC-DOC-04 | Download Dokumen | Klik pada nama dokumen di sidebar | File berhasil diunduh ke komputer | [✅ ] |

---

## 5. Skenario Pengujian: Pelaporan & Audit
Fokus: Output sistem dan pencatatan aktivitas.

| ID | Kasus Uji | Langkah | Hasil yang Diharapkan | Status |
|----|-----------|---------|-----------------------|--------|
<<<<<<< HEAD
| TC-REP-01 | View Report | Buka dashboard Client -> Klik link Report | Muncul halaman ringkasan proyek | [ ✅ FIXED (Tombol View Report sudah ditambahkan di Detail Project) ] |
| TC-REP-02 | Print Report | Klik tombol "Print / Save PDF" | Dialog print browser muncul (bersih tanpa sidebar) | [✅ FIXED (Akan berfungsi setelah TC-REP-01 bisa diakses) ] |
| TC-AUD-01 | Cek Activity Log | Lakukan login/update status -> Cek DB | Entry baru muncul di tabel `activity_logs` | [✅ FIXED (Terkait dengan error TC-TASK-02) ] |
=======

## 🚀 Instruksi Eksekusi Testing

1.  **Persiapan Data**: Pastikan Anda sudah menjalankan `database.sql` untuk mendapatkan akun demo.
2.  **Lakukan "Happy Path"**: Ikuti alur normal: PM buat proyek -> PM buat task -> Dev login -> Dev geser task ke Done -> Client login -> Client lihat progres.
3.  **Lakukan "Boundary/Error Testing"**: Coba upload file aneh, coba login dengan data salah, coba akses URL detail proyek milik orang lain secara manual.
4.  **Catat Temuan**: Jika ada tombol yang tidak berfungsi atau tampilan berantakan di layar kecil, catat di kolom status atau buat daftar "Bug" di bawah dokumen ini.

---
*Dokumen ini merupakan bagian dari siklus QA VibeFlow v2.0*
