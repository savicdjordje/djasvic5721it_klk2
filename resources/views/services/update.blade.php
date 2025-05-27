@extends('layouts.admin')

@section('title', 'Izmeni uslugu')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="m-0 font-weight-bold text-primary">Izmena usluge: {{ $service->name }}</h4>
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
        <form method="POST" action="{{ route('admin.services.update-submit', $service->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $service->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Opis</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Cena (RSD)</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $service->price) }}" required>
            </div>

            <div class="form-group">
                <label for="service_type_id">Tip usluge</label>
                <select name="service_type_id" id="service_type_id" class="form-control">
                    <option value="">Bez tipa</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $service->service_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Slika (opciono)</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
            <a href="{{ route('admin.services.list') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection
