<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('home', [
            'nama' => 'Aragorn', 
            'nrp' => '808'
        ]);
    }

    public function about() {
        return view('about', [
            'profil' => 'Departemen Teknik Informatika ITS adalah salah satu 
            departemen unggulan di bawah Fakultas Teknologi Elektro dan Informatika Cerdas (FTEIC) 
            Institut Teknologi Sepuluh Nopember (ITS) di Surabaya.'
        ]);
    }

    public function project() {
        return view('project-idea', [
            'tema' => 'Database Health Checker & Performance Monitor, agentic AI 
            bertugas memantau kesehatan database, menganalisis metrik performa secara real-time, 
            mendeteksi query yang lambat (slow queries), serta memberikan rekomendasi otomatis untuk 
            optimasi sistem penyimpanan data agar aplikasi berjalan lancar dan efisien.'
        ]);
    }

    public function hitung($angka1, $angka2, $operasi) {
        if (!is_numeric($angka1) || !is_numeric($angka2)) {
            return 'Error: Parameter input wajib berupa angka!';
        }

        $a = (float) $angka1; $b = (float) $angka2;

        switch ($operasi) {
            case 'tambah': $hasil = $a + $b; break;
            case 'kurang': $hasil = $a - $b; break;
            case 'kali': $hasil = $a * $b; break;
            case 'bagi':
                if ($b == 0) return 'Error: Pembagian dengan nol terdeteksi!';
                $hasil = $a / $b; break;
            default:
                return 'Error: Operasi tidak didukung! Gunakan: tambah, kurang, kali, atau bagi.';
        }

        $kalimat = "Hasil dari {$angka1} {$operasi} {$angka2} adalah {$hasil}";

        return view('operation', compact('kalimat'));
    }
}
