@extends('layouts.admin')

@section('title', 'Izmena tipa usluge')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="m-0 font-weight-bold text-primary">Izmena tipa usluge: {{ $type->name }}</h4>
    </div>
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
        <form method="POST" action="{{ route('admin.service-types.update-submit', $type->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $type->name) }}">
            </div>

            <div class="form-group">
                <label for="description">Opis</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $type->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
            <a href="{{ route('admin.service-types.list') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection
