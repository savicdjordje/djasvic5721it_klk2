@extends('layouts.public')

@section('title', 'Nova rezervacija')

@section('content')
<div class="w3-container w3-padding-64" style="max-width:800px; margin:auto">
    <h2 class="w3-xxlarge w3-center w3-text-orange">Nova rezervacija</h2>

    @if ($errors->any())
        <div class="w3-panel w3-red w3-round-large w3-padding w3-margin-top">
            <ul class="w3-ul">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.create-submit', $service_id) }}" method="POST" class="w3-container w3-card-4 w3-white w3-padding w3-round-large w3-margin-top">
        @csrf

        <label class="w3-text-grey"><b>Marka auta</b></label>
        <input type="text" name="car_brand" class="w3-input w3-border w3-round w3-margin-bottom" value="{{ old('car_brand') }}" required>

        <label class="w3-text-grey"><b>Model auta</b></label>
        <input type="text" name="car_model" class="w3-input w3-border w3-round w3-margin-bottom" value="{{ old('car_model') }}" required>

        <label class="w3-text-grey"><b>Registracija</b></label>
        <input type="text" name="car_plate" class="w3-input w3-border w3-round w3-margin-bottom" value="{{ old('car_plate') }}" required>

        <label class="w3-text-grey"><b>Napomena</b></label>
        <textarea name="note" class="w3-input w3-border w3-round w3-margin-bottom">{{ old('note') }}</textarea>

        <label class="w3-text-grey"><b>Datum i vreme</b></label>
        <input type="datetime-local" name="scheduled_at" class="w3-input w3-border w3-round w3-margin-bottom" value="{{ old('scheduled_at') }}" required>

        <button type="submit" class="w3-button w3-orange w3-round-large w3-margin-top">Zakaži</button>
    </form>
</div>
@endsection
