@extends('layouts.app')

@section('title', 'Home - Profil Kelompok')

@section('content')
<div class="text-center mb-10">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Profil Kelompok</h1>
    <p class="text-lg text-gray-600">Daftar anggota yang berpartisipasi dalam proyek ini.</p>
</div>
    
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($anggota as $member)
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-300 p-6 flex items-center space-x-4">
        <div class="h-14 w-14 flex-shrink-0 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 text-xl font-bold uppercase">
            {{ substr($member['nama'], 0, 1) }}
        </div>
        <div class="overflow-hidden">
            <h2 class="text-lg font-semibold text-gray-800 truncate" title="{{ $member['nama'] }}">
                {{ $member['nama'] }}
            </h2>
            <p class="text-indigo-600 font-medium text-sm">NRP: {{ $member['nrp'] }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
