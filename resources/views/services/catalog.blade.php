@extends('layouts.public')

@section('title', 'Katalog usluga')

@section('content')
<section class="w3-container w3-padding-64">
    <h2 class="w3-center w3-xxlarge w3-border-bottom w3-padding-16">Katalog usluga</h2>

    <div class="w3-row-padding w3-margin-top">
        @forelse($services as $service)
            <div class="w3-third w3-margin-bottom">
                <div class="w3-card-4">
                    <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" style="width:100%; height: 220px; object-fit: cover;">
                    <div class="w3-container w3-padding">
                        <h5>{{ $service->name }}</h5>
                        <p>{{ $service->description }}</p>
                        <p><strong>Tip usluge:</strong> {{ $service->type->name ?? 'Nema'}}</p>
                        <p><strong>Cena:</strong> {{ $service->price }} RSD</p>
                        <a href="{{ route('services.detail', $service->id) }}" class="w3-button w3-black w3-margin-top">Opširnije</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="w3-center">Trenutno nema dostupnih usluga.</p>
        @endforelse
    </div>
</section>
@endsection
