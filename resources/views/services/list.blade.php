@extends('layouts.admin')

@section('title', 'Lista usluga')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.services.create') }}" class="btn btn-success">
            + Kreiraj uslugu
        </a>
    </div>

    <x-datatable :headers="['ID', 'Naziv', 'Tip', 'Istaknuta', 'Prikazana', 'Istakni', 'Prikaži', 'Izmeni', 'Obriši']">
        @foreach ($services as $s)
        <tr>
            <td>
                <a href="{{ route('admin.services.single', $s->id) }}">
                    {{ $s->id }}
                </a>
            </td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->type->name ?? '-' }}</td>
            <td>{{ $s->featured ? 'DA' : 'NE' }}</td>
            <td>{{ $s->published ? 'DA' : 'NE' }}</td>

            <td>
                <form method="POST" action="{{ route('admin.services.toggle-featured', $s->id) }}">
                    @csrf
                    <button class="btn btn-sm btn-warning" type="submit">
                        {{ $s->featured ? 'Ukloni' : 'Istakni' }}
                    </button>
                </form>
            </td>

            <td>
                <form method="POST" action="{{ route('admin.services.toggle-published', $s->id) }}">
                    @csrf
                    <button class="btn btn-sm btn-secondary" type="submit">
                        {{ $s->published ? 'Sakrij' : 'Prikaži' }}
                    </button>
                </form>
            </td>

            <td>
                <a href="{{ route('admin.services.update', $s->id) }}" class="btn btn-sm btn-primary">Izmeni</a>
            </td>

            <td>
                <form method="POST" action="{{ route('admin.services.delete', $s->id) }}" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu uslugu?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Obriši</button>
                </form>
            </td>
        </tr>
        @endforeach
    </x-datatable>
@endsection

@push('scripts')
    @include('components.datatables-scripts')
@endpush
