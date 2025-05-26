<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AutoLak')</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
        .w3-bar-block .w3-bar-item {padding:20px}
    </style>
    @vite('resources/css/app.css')
</head>
<body>

<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">

    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button" style="position: absolute; top: 0; right: 0;">&times;</a>

    <a href="{{ route('homepage') }}" onclick="w3_close()" class="w3-bar-item w3-button">Početna</a>
    <a href="{{ route('services.catalog') }}" onclick="w3_close()" class="w3-bar-item w3-button">Katalog</a>
    <a href="{{ route('contact-messages.create') }}" onclick="w3_close()" class="w3-bar-item w3-button">Kontakt</a>

    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w3-bar-item w3-button w3-red w3-margin-top">Logout</button>
        </form>
    @endauth
</nav>

<div class="w3-top">
    <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
        <div class="w3-right w3-padding-16">
            @auth
                @if(in_array(auth()->user()->role, ['admin', 'editor']))
                    <a href="{{ route('admin.dashboard') }}" class="w3-button">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="w3-button">Login</a>
            @endauth

        </div>
        <div class="w3-display-container w3-center w3-padding-16">
            <a href="{{ route('homepage') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:60px; max-width: 220px; object-fit: contain;">
            </a>
        </div>
    </div>
</div>

<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    @yield('content')
</div>

<footer class="w3-row-padding w3-padding-32">
        <hr>
        <div class="w3-center">
            <h3>DJSAVIC5721IT</h3>
        </div>
    </footer>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
</script>

</body>
</html>
