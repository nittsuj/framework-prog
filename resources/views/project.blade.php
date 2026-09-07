@extends('layouts.app')

@section('title', 'Project Idea')

@section('content')
<h1 class="text-3xl font-bold text-gray-900 mb-6 border-b pb-2 border-gray-200">Ide Proyek</h1>
<div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
    <h3 class="text-xl font-semibold text-blue-800 mb-3">Database Health Checker & Performance Monitor</h3>
    <p class="text-gray-700 leading-relaxed">{{ $tema }}</p>
</div>
@endsection
