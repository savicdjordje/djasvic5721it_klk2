@extends('layouts.public')

@section('title', 'Moje rezervacije')

@section('content')
<div class="w3-container w3-padding-32">
    <h2 class="w3-xxlarge w3-center w3-text-orange">Moje rezervacije</h2>

    @if($reservations->isEmpty())
        <div class="w3-panel w3-pale-yellow w3-border w3-border-yellow w3-round-large w3-margin-top">
            <p class="w3-large w3-center">Nemate nijednu rezervaciju.</p>
        </div>
    @else
        <div class="w3-responsive w3-margin-top">
            <table class="w3-table-all w3-hoverable w3-card-4 w3-white w3-bordered">
                <thead>
                    <tr class="w3-orange">
                        <th>Usluga</th>
                        <th>Datum zakazivanja</th>
                        <th>Auto</th>
                        <th>Napomena</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->service->name ?? 'Obrisana usluga' }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->scheduled_at)->format('d.m.Y. H:i') }}</td>
                        <td>{{ $reservation->car_brand }} {{ $reservation->car_model }} ({{ $reservation->car_plate }})</td>
                        <td>{{ $reservation->note ?: '-' }}</td>
                        <td>
                            @if($reservation->approved)
                                <span class="w3-tag w3-green w3-round">Odobrena</span>
                            @else
                                <span class="w3-tag w3-light-gray w3-round">Na čekanju</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
