@extends('layouts.admin')

@section('title', 'Detalji korisnika')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header"><h4 class="m-0 font-weight-bold text-primary">Korisnik: {{ $user->full_name }}</h4></div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Ime i prezime:</strong> {{ $user->full_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Uloga:</strong> {{ $user->role }}</p>
        <p><strong>Kreiran:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>

        <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">← Nazad na listu</a>
    </div>
</div>
@endsection
