@extends('layouts.admin')

@section('title', 'Korisnici')

@section('content')
    <x-datatable :headers="['ID', 'Ime i Prezime', 'Email', 'Uloga', 'Izmeni', 'Obriši']">
        @foreach ($users as $u)
            <tr>
                <td>
                    <a href="{{ route('admin.users.single', $u->id) }}">
                        {{ $u->id }}
                    </a>
                </td>
                <td>{{ $u->full_name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <a href="{{ route('admin.users.update', $u->id) }}" class="btn btn-sm btn-info">Izmeni</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.users.delete', $u->id) }}" onsubmit="return confirm('Obrisati korisnika?');">
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
