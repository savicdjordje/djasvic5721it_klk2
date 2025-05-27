@extends('layouts.admin')

@section('title', 'Izmeni korisnika')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header"><h4 class="m-0 font-weight-bold text-primary">Izmena korisnika: {{ $user->full_name }}</h4></div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.users.update-submit', $user->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="full_name">Ime i prezime</label>
                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email adresa</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="role">Uloga</label>
                <select name="role" class="form-control" required>
                    <option value="registered" {{ $user->role === 'registered' ? 'selected' : '' }}>Registered</option>
                    <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
            <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection
