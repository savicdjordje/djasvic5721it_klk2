@extends('layouts.admin')

@section('title', 'Detalji tipa usluge')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="m-0 font-weight-bold text-primary">Tip usluge: #{{ $type->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $type->id }}</p>
            <p><strong>Naziv:</strong> {{ $type->name }}</p>
            <p><strong>Kreirano:</strong> {{ $type->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Ažurirano:</strong> {{ $type->updated_at->format('d.m.Y H:i') }}</p>

            <a href="{{ route('admin.service-types.list') }}" class="btn btn-secondary mt-3">
                &larr; Nazad na listu
            </a>
        </div>
    </div>
@endsection
