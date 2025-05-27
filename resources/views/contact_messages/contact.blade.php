@extends('layouts.public')

@section('title', 'Kontakt')

@section('content')
<section class="w3-container w3-padding-64">
    <h2 class="w3-xxlarge">Kontakt</h2>
    <p class="w3-large w3-opacity">
        Ukoliko imate pitanja ili želite da zakažete termin, slobodno nas kontaktirajte.
    </p>

    @if(session('success'))
        <div class="w3-panel w3-green w3-padding">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact-messages.createSubmit') }}" method="POST" class="w3-container w3-card-4 w3-padding w3-margin-top w3-white">
        @csrf
        <p>
            <label>Ime i prezime*</label>
            <input class="w3-input w3-border" type="text" name="name" required value="{{ old('name') }}">
        </p>
        <p>
            <label>Email*</label>
            <input class="w3-input w3-border" type="email" name="email" required value="{{ old('email') }}">
        </p>
        <p>
            <label>Naslov</label>
            <input class="w3-input w3-border" type="text" name="subject" value="{{ old('subject') }}">
        </p>
        <p>
            <label>Poruka*</label>
            <textarea class="w3-input w3-border" name="message" rows="5" required>{{ old('message') }}</textarea>
        </p>
        <p>
            <button class="w3-button w3-black" type="submit">Pošalji</button>
        </p>
    </form>

    <h3 class="w3-margin-top w3-xlarge">Kontakt podaci</h3>
    <ul class="w3-ul w3-card-4 w3-white w3-margin-top w3-padding">
        <li class="w3-padding-16"><strong>Adresa:</strong> Knez Mihailova 6, 11000 Beograd (Računarski fakultet)</li>
        <li class="w3-padding-16"><strong>Telefon:</strong> +381 63 123 456</li>
        <li class="w3-padding-16"><strong>Email:</strong> autolak@servis.rs</li>
        <li class="w3-padding-16"><strong>Radno vreme:</strong> Pon–Pet: 08–18h, Subota: 09–15h</li>
    </ul>

    <h3 class="w3-margin-top w3-xlarge">Gde se nalazimo:</h3>
    <div class="w3-margin-top w3-responsive">
        <iframe 
            class="w3-border" 
            style="width:100%; height:400px;" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.9588453210366!2d20.45727301553626!3d44.81413397909871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7ab96f4f0d4b%3A0x23e8b97e6b113afc!2z0JHQtdC70LDQstC40YUg0Lgg0LzQsNC90LjRgtC10YXQvdC40LkgKExha2lyaW5qZSk!5e0!3m2!1ssr!2srs!4v1711364893256" 
            allowfullscreen loading="lazy">
        </iframe>
    </div>
</section>
@endsection

{{-- @push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea[name=message]',
        menubar: false,
        plugins: 'lists link',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link',
        height: 300
    });
</script>
@endpush --}}