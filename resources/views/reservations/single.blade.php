@extends('layouts.admin')

@section('title', 'Pregled rezervacije')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header"><h4 class="m-0 font-weight-bold text-primary">Rezervacija #{{ $reservation->id }}</h4></div>
    <div class="card-body">
        <p><strong>Korisnik:</strong> {{ $reservation->user->full_name ?? '-' }}</p>
        <p><strong>Usluga:</strong> {{ $reservation->service->name ?? '-' }}</p>
        <p><strong>Vozilo:</strong> {{ $reservation->car_brand }} {{ $reservation->car_model }} ({{ $reservation->car_plate }})</p>
        <p><strong>Zakazano za:</strong> {{ \Carbon\Carbon::parse($reservation->scheduled_at)->format('d.m.Y H:i') }}</p>
        <p><strong>Napomena:</strong> {{ $reservation->note ?? '-' }}</p>
        <p><strong>Status:</strong> {{ $reservation->approved ? 'Aktivna' : 'Arhivirana' }}</p>

        <a href="{{ route('admin.reservations.list') }}" class="btn btn-secondary">← Nazad</a>
    </div>
</div>
@endsection
