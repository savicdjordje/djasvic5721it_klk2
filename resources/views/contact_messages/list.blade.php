@extends('layouts.admin')

@section('title', 'Kontakt poruke')

@section('content')

<h3>Aktivne poruke</h3>
@if ($active->isEmpty())
    <p class="text-muted">Nema aktivnih poruka.</p>
@else
    <x-datatable :headers="['ID', 'Ime', 'Email', 'Naslov', 'Poruka', 'Arhiviraj', 'Obriši']">
        @foreach ($active as $msg)
            <tr>
                <td>{{ $msg->id }}</td>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->subject ?? '-' }}</td>
                <td>{{ Str::limit($msg->message, 50) }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.contact-messages.archive', $msg->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-warning" type="submit">Arhiviraj</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.contact-messages.delete', $msg->id) }}" onsubmit="return confirm('Obrisati poruku?');">
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

<h3>Arhivirane poruke</h3>
@if ($archived->isEmpty())
    <p class="text-muted">Nema arhiviranih poruka.</p>
@else
    <x-datatable :headers="['ID', 'Ime', 'Email', 'Naslov', 'Poruka', 'Aktiviraj', 'Obriši']">
        @foreach ($archived as $msg)
            <tr>
                <td>{{ $msg->id }}</td>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->subject ?? '-' }}</td>
                <td>{{ Str::limit($msg->message, 50) }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.contact-messages.unarchive', $msg->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-success" type="submit">Aktiviraj</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.contact-messages.delete', $msg->id) }}" onsubmit="return confirm('Obrisati poruku?');">
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
