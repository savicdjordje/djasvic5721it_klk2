@extends('layouts.admin')

@section('title', 'Detalji usluge')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="m-0 font-weight-bold text-primary">Usluga: {{ $service->name }}</h4>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $service->id }}</p>
        <p><strong>Naziv:</strong> {{ $service->name }}</p>
        <p><strong>Opis:</strong> {{ $service->description }}</p>
        <p><strong>Cena:</strong> {{ number_format($service->price, 2) }} RSD</p>
        <p><strong>Tip usluge:</strong> {{ $service->serviceType->name ?? 'Bez tipa' }}</p>
        <p><strong>Istaknuta:</strong> {{ $service->featured ? 'DA' : 'NE' }}</p>
        <p><strong>Prikazana:</strong> {{ $service->published ? 'DA' : 'NE' }}</p>
        <p><strong>Datum kreiranja:</strong> {{ $service->created_at->format('d.m.Y H:i') }}</p>

        @if ($service->image)
            <p><strong>Slika:</strong><br>
                <img src="{{ asset( $service->image) }}" alt="{{ $service->name }}" class="img-fluid mt-2" style="max-width: 300px;">
            </p>
        @endif

        <a href="{{ route('admin.services.list') }}" class="btn btn-secondary">← Nazad na listu</a>
    </div>
</div>
@endsection
