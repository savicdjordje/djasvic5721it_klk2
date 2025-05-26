@extends('layouts.public')

@section('title', $service->name)

@section('content')
<section class="w3-container w3-padding-64">
    <h2 class="w3-xxlarge">{{ $service->name }}</h2>

    <div class="w3-row-padding w3-margin-top">
        <div class="w3-col l6 m12">
            <img src="{{ asset( $service->image) }}" style="width:100%; max-height:400px; object-fit:cover;" class="w3-image w3-round w3-margin-bottom" alt="{{ $service->name }}">
        </div>
        <div class="w3-col l6 m12">
            <p><strong>Opis:</strong> {{ $service->description }}</p>
            <p><strong>Cena:</strong> {{ $service->price }} RSD</p>
            <p><strong>Tip usluge:</strong> {{ $service->type->name }}</p>
            <p><strong>Opis tipa usluge:</strong> {{ $service->type->description }}</p>

            @auth
                <a href="{{ route('reservations.create', ['service_id' => $service->id]) }}" class="w3-button w3-green w3-margin-top">Rezerviši</a>
            @endauth

            <a href="{{ url()->previous() }}" class="w3-button w3-black w3-margin-top">Nazad</a>
        </div>
    </div>
</section>
@endsection
