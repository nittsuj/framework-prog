@extends('layouts.app')

@section('title', 'About')

@section('content')
<h1 class="text-3xl font-bold text-gray-900 mb-6 border-b pb-2 border-gray-200">Tentang</h1>
<div class="prose prose-indigo max-w-none text-gray-700 leading-relaxed">
    <p class="text-lg">{{ $profil }}</p>
</div>
@endsection
