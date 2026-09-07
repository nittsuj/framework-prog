@extends('layouts.app')

@section('title', 'Kalkulator')

@section('content')
    <div class="mx-auto mt-6 max-w-xl">
        <h1 class="text-3xl font-bold text-gray-900">Kalkulator Dinamis</h1>
        <p class="mt-2 text-gray-600">Hasil akan dibuka melalui URL <code>/hitung/{angka1}/{angka2}/{operasi}</code>.</p>

        <form method="GET" action="{{ route('calculator') }}" class="mt-8 space-y-5 rounded-xl border border-indigo-100 bg-indigo-50 p-6 shadow-sm">
            <div>
                <label for="angka1" class="mb-1 block font-medium text-gray-700">Angka pertama</label>
                <input id="angka1" name="angka1" type="number" step="any" value="{{ old('angka1') }}" class="w-full rounded-md border border-gray-300 px-3 py-2" required>
                @error('angka1')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="angka2" class="mb-1 block font-medium text-gray-700">Angka kedua</label>
                <input id="angka2" name="angka2" type="number" step="any" value="{{ old('angka2') }}" class="w-full rounded-md border border-gray-300 px-3 py-2" required>
                @error('angka2')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="operasi" class="mb-1 block font-medium text-gray-700">Operasi</label>
                <select id="operasi" name="operasi" class="w-full rounded-md border border-gray-300 px-3 py-2" required>
                    <option value="tambah" @selected(old('operasi') === 'tambah')>Tambah</option>
                    <option value="kurang" @selected(old('operasi') === 'kurang')>Kurang</option>
                    <option value="kali" @selected(old('operasi') === 'kali')>Kali</option>
                    <option value="bagi" @selected(old('operasi') === 'bagi')>Bagi</option>
                </select>
                @error('operasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="rounded-md bg-indigo-600 px-5 py-2.5 font-medium text-white hover:bg-indigo-700">Hitung</button>
        </form>
    </div>
@endsection
