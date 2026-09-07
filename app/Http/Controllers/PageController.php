<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PageController extends Controller
{
    private const OPERATIONS = ['tambah', 'kurang', 'kali', 'bagi'];

    /**
     * Menampilkan halaman utama dengan daftar anggota kelompok.
     */
    public function index(): View
    {
        $anggota = [
            ['nrp' => '5025241234', 'nama' => 'Justin Valentino'],
            ['nrp' => '5025241268', 'nama' => 'Raymond Julius Pardosi'],
            ['nrp' => '5025241108', 'nama' => 'Indra Wahyu Tirtayasa'],
            ['nrp' => '5025241140', 'nama' => 'Brave Juliada'],
            ['nrp' => '5025241085', 'nama' => 'Mario Napitupulu'],
            ['nrp' => '5025221107', 'nama' => 'Dzuhrillah Hendraines'],
        ];

        return view('home', compact('anggota'));
    }

    /**
     * Menampilkan halaman tentang.
     */
    public function about(): View
    {
        return view('about', [
            'profil' => 'Departemen Teknik Informatika ITS adalah salah satu departemen unggulan di bawah Fakultas Teknologi Elektro dan Informatika Cerdas (FTEIC) Institut Teknologi Sepuluh Nopember (ITS) di Surabaya.',
        ]);
    }

    /**
     * Menampilkan ide proyek.
     */
    public function project(): View
    {
        return view('project-idea', [
            'tema' => 'Database Health Checker & Performance Monitor, agentic AI bertugas memantau kesehatan database, menganalisis metrik performa secara real-time, mendeteksi query yang lambat (slow queries), serta memberikan rekomendasi otomatis untuk optimasi sistem penyimpanan data agar aplikasi berjalan lancar dan efisien.',
        ]);
    }

    /**
     * Menampilkan form kalkulator dan mengarahkan input ke URL hasil.
     */
    public function calculator(Request $request): View|RedirectResponse
    {
        if (! $request->hasAny(['angka1', 'angka2', 'operasi'])) {
            return view('calculator');
        }

        $validated = $request->validate([
            'angka1' => ['required', 'numeric'],
            'angka2' => ['required', 'numeric'],
            'operasi' => ['required', Rule::in(self::OPERATIONS)],
        ]);

        return redirect()->route('calculation', $validated);
    }

    /**
     * Menghitung operasi dari parameter URL yang diwajibkan pada tantangan.
     */
    public function hitung(string $angka1, string $angka2, string $operasi): View
    {
        if (! is_numeric($angka1) || ! is_numeric($angka2)) {
            return view('operation', [
                'error' => 'Parameter angka harus berupa nilai numerik.',
            ]);
        }

        if (! in_array($operasi, self::OPERATIONS, true)) {
            return view('operation', [
                'error' => 'Operasi tidak didukung. Gunakan tambah, kurang, kali, atau bagi.',
            ]);
        }

        $firstNumber = (float) $angka1;
        $secondNumber = (float) $angka2;

        switch ($operasi) {
            case 'tambah':
                $result = $firstNumber + $secondNumber;
                break;
            case 'kurang':
                $result = $firstNumber - $secondNumber;
                break;
            case 'kali':
                $result = $firstNumber * $secondNumber;
                break;
            case 'bagi':
                if ($secondNumber === 0.0) {
                    return view('operation', [
                        'error' => 'Pembagian dengan nol tidak dapat dilakukan.',
                    ]);
                }
                $result = $firstNumber / $secondNumber;
                break;
        }

        return view('operation', [
            'angka1' => $angka1,
            'angka2' => $angka2,
            'operasi' => $operasi,
            'hasil' => sprintf('%.12g', $result),
        ]);
    }
}
