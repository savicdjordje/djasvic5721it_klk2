@extends('layouts.admin')

@section('title', 'Unos novog tipa usluge')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="m-0 font-weight-bold text-primary">Unos novog tipa usluge</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.service-types.create-submit') }}">
            @csrf
            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Opis</label>
                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj</button>
            <a href="{{ route('admin.service-types.list') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection
