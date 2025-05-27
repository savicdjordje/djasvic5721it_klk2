@extends('layouts.admin')

@section('title', 'Rezervacije')

@section('content')

<h3>Aktivne rezervacije</h3>
@if ($active->isEmpty())
    <p class="text-muted">Nema aktivnih rezervacija.</p>
@else
    <x-datatable :headers="['ID', 'Korisnik', 'Usluga', 'Datum', 'Arhiviraj', 'Izmeni', 'Obriši']">
        @foreach ($active as $r)
            <tr>
                <td><a href="{{ route('admin.reservations.single', $r->id) }}">{{ $r->id }}</a></td>
                <td>{{ $r->user->full_name ?? 'Nepoznato' }}</td>
                <td>{{ $r->service->name ?? '-' }}</td>
                <td>{{ $r->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.reservations.archive', $r->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-warning" type="submit">Arhiviraj</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.reservations.update', $r->id) }}" class="btn btn-sm btn-primary">Izmeni</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.reservations.delete', $r->id) }}" onsubmit="return confirm('Obrisati rezervaciju?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Obriši</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-datatable>
@endif

<hr class="my-5">

<h3>Arhivirane rezervacije</h3>
@if ($archived->isEmpty())
    <p class="text-muted">Nema arhiviranih rezervacija.</p>
@else
    <x-datatable :headers="['ID', 'Korisnik', 'Usluga', 'Datum', 'Aktiviraj', 'Izmeni', 'Obriši']">
        @foreach ($archived as $r)
            <tr>
                <td><a href="{{ route('admin.reservations.single', $r->id) }}">{{ $r->id }}</a></td>
                <td>{{ $r->user->full_name ?? 'Nepoznato' }}</td>
                <td>{{ $r->service->name ?? '-' }}</td>
                <td>{{ $r->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.reservations.unarchive', $r->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-success" type="submit">Aktiviraj</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.reservations.update', $r->id) }}" class="btn btn-sm btn-primary">Izmeni</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.reservations.delete', $r->id) }}" onsubmit="return confirm('Obrisati rezervaciju?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Obriši</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-datatable>
@endif

@endsection

@push('scripts')
    @include('components.datatables-scripts')
@endpush
