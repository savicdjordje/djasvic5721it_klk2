@extends('layouts.admin')

@section('title', 'Tipovi usluga')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.service-types.create') }}" class="btn btn-success">
            + Kreiraj tip usluge
        </a>
    </div>

    <x-datatable :headers="['ID', 'Naziv', 'Izmeni', 'Obriši']">
        @foreach ($types as $t)
            <tr>
                <td>
                    <a href="{{ route('admin.service-types.single', $t->id) }}">
                        {{ $t->id }}
                    </a>
                </td>
                <td>{{ $t->name }}</td>
                <td>
                    <a href="{{ route('admin.service-types.update', $t->id) }}" class="btn btn-sm btn-warning">Izmeni</a>
                </td>
                <td>
                    <form action="{{ route('admin.service-types.delete', $t->id) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj tip usluge?');">
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
