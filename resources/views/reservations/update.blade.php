@extends('layouts.admin')

@section('title', 'Izmeni rezervaciju')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="m-0 font-weight-bold text-primary">Izmena rezervacije #{{ $reservation->id }}</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.reservations.update-submit', $reservation->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="car_brand">Marka auta</label>
                <input type="text" name="car_brand" class="form-control" value="{{ old('car_brand', $reservation->car_brand) }}" required>
            </div>

            <div class="form-group">
                <label for="car_model">Model auta</label>
                <input type="text" name="car_model" class="form-control" value="{{ old('car_model', $reservation->car_model) }}" required>
            </div>

            <div class="form-group">
                <label for="car_plate">Tablice</label>
                <input type="text" name="car_plate" class="form-control" value="{{ old('car_plate', $reservation->car_plate) }}" required>
            </div>

            <div class="form-group">
                <label for="scheduled_at">Zakazano za</label>
                <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at', \Carbon\Carbon::parse($reservation->scheduled_at)->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div class="form-group">
                <label for="note">Napomena</label>
                <textarea name="note" class="form-control" rows="3">{{ old('note', $reservation->note) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj</button>
            <a href="{{ route('admin.reservations.list') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection
