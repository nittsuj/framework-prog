<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
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
        return view('project', [
            'tema' => 'Database Health Checker & Performance Monitor, agentic AI 
            bertugas memantau kesehatan database, menganalisis metrik performa secara real-time, 
            mendeteksi query yang lambat (slow queries), serta memberikan rekomendasi otomatis untuk 
            optimasi sistem penyimpanan data agar aplikasi berjalan lancar dan efisien.'
        ]);
    }
}
