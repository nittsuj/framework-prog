@extends('layouts.app')

@section('title', 'Kalkulator Dinamis')

@section('content')
<div class="text-center max-w-xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Kalkulator Dinamis</h1>

    <div class="bg-indigo-50 border border-indigo-200 p-8 rounded-xl shadow-sm">
        @isset($error)
            <p class="text-red-700 text-xl font-semibold" role="alert">{{ $error }}</p>
        @else
            <p class="text-indigo-900 text-2xl font-semibold">Hasil dari {{ $angka1 }} {{ $operasi }} {{ $angka2 }} adalah {{ $hasil }}</p>
        @endisset
    </div>

    <div class="mt-8 text-gray-500 text-sm">
        <a href="{{ route('calculator') }}" class="inline-flex rounded-md bg-indigo-600 px-4 py-2 font-medium text-white hover:bg-indigo-700">Hitung lagi</a>
        <p>Format: <code>/hitung/{angka1}/{angka2}/{operasi}</code></p>
        <p>Operasi: <code>tambah</code>, <code>kurang</code>, <code>kali</code>, <code>bagi</code></p>
    </div>
</div>
@endsection
