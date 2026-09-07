# Sistem Informasi Statik Profil Mahasiswa

Aplikasi web Laravel untuk Tugas Mandiri PBKK Pertemuan 1, dikerjakan oleh Kelompok 8.

Tugas ini menitikberatkan pada satu hal, yaitu satu siklus navigasi dasar Laravel yang berjalan dengan benar dari awal hingga akhir:

```
Browser (URL)  →  routes/web.php  →  PageController  →  Blade view  →  HTML
```

Stack yang digunakan: Laravel 13, PHP 8.5, Tailwind CSS (via CDN), dan SQLite.

---

## 1. Cara Menjalankan (dari nol)

Prasyarat: PHP 8.3+ dan Composer sudah terpasang. Periksa dengan `php -v` dan `composer -V`.

Apabila keduanya belum tersedia, pasang terlebih dahulu melalui PowerShell, kemudian tutup dan buka ulang terminal:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Selanjutnya, jalankan satu perintah berikut dari folder proyek:

```sh
composer setup
```

Perintah tersebut menjalankan secara berurutan: `composer install`, pembuatan `.env` dari `.env.example`, `php artisan key:generate`, `php artisan migrate`, `npm install`, dan `npm run build`.

Apabila ingin melakukannya secara manual, urutannya sebagai berikut:

```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

Pengguna PowerShell mengganti `cp .env.example .env` dengan `copy .env.example .env`.

Setelah itu, nyalakan server:

```sh
php artisan serve
```

Aplikasi dapat diakses pada <http://localhost:8000>.

### Alasan `php artisan migrate` tetap diperlukan meski tanpa database

Seluruh data pada aplikasi ini ditulis langsung di dalam controller. Tidak ada satu pun model atau tabel yang digunakan oleh halaman.

Meskipun demikian, berkas `.env` menetapkan `SESSION_DRIVER=database` dengan `DB_CONNECTION=sqlite`, sehingga Laravel tetap membaca tabel `sessions` pada setiap request. Apabila berkas `database/database.sqlite` belum tersedia, seluruh halaman gagal dimuat dengan galat 500 `SQLiteDatabaseDoesNotExistException`. Pesan galat tersebut menyebut tabel `sessions` dan berhenti pada middleware `StartSession`, sehingga penyebabnya berada di luar kode tugas ini.

Penyelesaiannya sudah tercakup di dalam `composer setup`:

```sh
php artisan migrate
```

Apabila berkas databasenya sendiri belum ada, buat berkas kosongnya terlebih dahulu dengan `touch database/database.sqlite`, atau melalui PowerShell:

```powershell
New-Item -ItemType File database\database.sqlite
```

> Berkas `database/database.sqlite` dan `.env` didaftarkan pada `.gitignore` dan tidak diunggah ke GitHub, sesuai ketentuan pengumpulan tugas. Karena itu, setiap anggota kelompok perlu menjalankan langkah setup di atas pada komputer masing-masing.

---

## 2. Daftar Rute

Daftar berikut dapat diverifikasi kapan saja melalui `php artisan route:list --except-vendor`.

| Method & URL | Nama rute | Controller | View | Keterangan |
|---|---|---|---|---|
| `GET /` | `home` | `PageController@index` | `home.blade.php` | Profil kelompok berisi nama dan NRP seluruh anggota |
| `GET /about` | `about` | `PageController@about` | `about.blade.php` | Profil singkat Departemen Teknik Informatika ITS |
| `GET /project-idea` | `project` | `PageController@project` | `project-idea.blade.php` | Deskripsi rencana proyek Agentic AI kelompok |
| `GET /hitung` | `calculator` | `PageController@calculator` | `calculator.blade.php` | Form input kalkulator (tambahan, di luar spesifikasi) |
| `GET /hitung/{angka1}/{angka2}/{operasi}` | `calculation` | `PageController@hitung` | `operation.blade.php` | Kalkulator dinamis sesuai spesifikasi tantangan |

### Aturan arsitektur: tanpa Closure

Spesifikasi tugas melarang penggunaan Closure pada `routes/web.php` untuk merender tampilan, sehingga penulisan seperti berikut tidak diperbolehkan:

```php
Route::get('/about', function () { return view('about'); });   // DILARANG
```

Seluruh rute wajib didelegasikan ke method pada `PageController`:

```php
Route::get('/about', [PageController::class, 'about'])->name('about');   // BENAR
```

Setiap rute juga diberi nama, dan tautan pada navbar memanggil `route('nama')` alih-alih URL yang ditulis manual. Dengan pendekatan tersebut, perubahan URL pada satu tempat akan langsung terbawa ke seluruh tautan.

---

## 3. Kalkulator Dinamis

Sebagai contoh, <http://localhost:8000/hitung/10/5/kali> menampilkan kalimat "Hasil dari 10 kali 5 adalah 50".

- Operasi yang didukung: `tambah` (+), `kurang` (−), `kali` (×), dan `bagi` (÷). Kata kunci di luar keempatnya akan ditolak.
- Angka divalidasi menggunakan `is_numeric()`, sehingga nilai desimal dan bilangan negatif turut diterima.
- Hasil diformat menggunakan `sprintf('%.12g', ...)` agar operasi pembagian tidak menghasilkan ekor desimal yang panjang.
- Kondisi galat ditangani dan ditampilkan sebagai pesan pada halaman:

  | Kondisi | Pesan yang muncul |
  |---|---|
  | Angka bukan numerik | Parameter angka harus berupa nilai numerik. |
  | Operasi tidak dikenal | Operasi tidak didukung. Gunakan tambah, kurang, kali, atau bagi. |
  | Pembagian dengan nol | Pembagian dengan nol tidak dapat dilakukan. |

Rute `/hitung` tanpa parameter menampilkan form. Setelah disubmit, form tersebut melakukan redirect ke `/hitung/{angka1}/{angka2}/{operasi}`, sehingga URL hasil tetap mengikuti format yang diminta spesifikasi serta dapat dibagikan maupun disimpan sebagai bookmark.

---

## 4. Struktur Proyek

Berikut berkas yang relevan dengan tugas ini.

```
routes/web.php                             Definisi 5 rute yang seluruhnya menunjuk ke PageController
app/Http/Controllers/PageController.php    Seluruh logika aplikasi
resources/views/
├── layouts/app.blade.php                  Kerangka HTML bersama: <head>, navbar, footer
├── home.blade.php                         Halaman /
├── about.blade.php                        Halaman /about
├── project-idea.blade.php                 Halaman /project-idea
├── calculator.blade.php                   Form di /hitung
└── operation.blade.php                    Hasil di /hitung/{angka1}/{angka2}/{operasi}
tests/Feature/CalculatorTest.php           4 pengujian otomatis untuk kalkulator
```

**Pewarisan layout.** Berkas `layouts/app.blade.php` memuat navbar, footer, dan `<script>` Tailwind. Halaman lain cukup menulis `@extends('layouts.app')` kemudian mengisi `@section('content')`, sehingga navbar hanya perlu ditulis satu kali. Menu yang sedang aktif disorot secara otomatis melalui `request()->routeIs(...)`.

**Sumber data.** Aplikasi ini tidak menggunakan database maupun model. Daftar anggota, teks profil departemen, dan deskripsi ide proyek disimpan sebagai array atau string di dalam `PageController`, kemudian dikirim ke view sebagai variabel.

**Catatan mengenai CSS.** Halaman-halaman ini memakai Tailwind melalui CDN (`<script src="https://cdn.tailwindcss.com">` pada `layouts/app.blade.php`), sesuai instruksi tugas. Pipeline Vite bawaan Laravel (`resources/css/app.css`, `vite.config.js`, `npm run build`) masih tersedia, namun tidak digunakan oleh halaman mana pun. Satu-satunya berkas yang memanggil `@vite(...)` adalah `welcome.blade.php`, halaman bawaan Laravel yang tidak terhubung ke rute apa pun. Perubahan tampilan cukup dilakukan pada kelas Tailwind di berkas Blade, tanpa perlu menjalankan `npm run build`.

---

## 5. Pengujian

```sh
composer test
```

Menjalankan satu berkas saja:

```sh
php artisan test tests/Feature/CalculatorTest.php
```

Menjalankan satu pengujian saja:

```sh
php artisan test --filter=test_division_by_zero_shows_a_helpful_message
```

Berkas `tests/Feature/CalculatorTest.php` memverifikasi empat hal: halaman form tampil, `/hitung/10/5/kali` menghasilkan kalimat yang benar, form melakukan redirect ke format URL yang diwajibkan, dan pembagian dengan nol memunculkan pesan yang tepat.

---

## 6. Format Kode

Sebelum melakukan commit, rapikan gaya penulisan PHP agar konsisten dengan standar PSR:

```sh
vendor/bin/pint --dirty
```

---

## Anggota Kelompok

| NRP | Nama |
|---|---|
| 5025241234 | Justin Valentino |
| 5025241268 | Raymond Julius Pardosi |
| 5025241108 | Indra Wahyu Tirtayasa |
| 5025241140 | Brave Juliada |
| 5025241085 | Mario Napitupulu |
| 5025221107 | Dzuhrillah Hendraines |
