## Framework Programming Team 8

### Routes yang diimplementasikan

| Route | Method Controller | Deskripsi |
|---|---|---|
| `GET /` | `PageController@index` | Halaman Home — menampilkan nama & NRP |
| `GET /about` | `PageController@about` | Halaman About — profil Departemen Informatika ITS |
| `GET /project-idea` | `PageController@project` | Halaman Project Idea — deskripsi tema proyek AI |
| `GET /hitung/{angka1}/{angka2}/{operasi}` | `PageController@hitung` | Kalkulator dinamis — operasi: `tambah`, `kurang`, `kali`, `bagi` |

### Fitur Kalkulator Dinamis

- Input: 2 angka integer melalui URL parameter (validasi regex `[0-9]+`)
- Operasi: `tambah` (+), `kurang` (−), `kali` (×), `bagi` (÷)
- Validasi: mencegah pembagian dengan nol, operasi tidak dikenal, dan input non-numerik
- Output: kalimat hasil kalkulasi

## Anggota Kelompok
+ 5025241234 Justin Valentino
+  Raymond Julius Pardosi
+ 5025241108 Indra Wahyu Tirtayasa
+ 5025241140 Brave Juliada
+  Mario Napitupulu
+ 5025221107Dzuhrillah Hendraines
