<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог одежды</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dark-theme {
            background: #000000;
            color: #e0e0e0;
            cursor: none;
        }

        .dark-theme .card {
            background: #1e1e1e;
            border-color: #333;
        }

        .dark-theme .card-header {
            background-color: #1e1e1e !important;
            border-bottom-color: #333;
        }

        .dark-theme .btn-outline-secondary,
        .dark-theme .btn-outline-primary,
        .dark-theme .btn-outline-success,
        .dark-theme .btn-outline-danger {
            border-color: #333;
            color: #e0e0e0;
        }
        .dark-theme .text-muted {
            color: #ffffff !important;
        }
        .dark-theme p {
            color: #ffffff !important;
        }

        .dark-theme .card {
            color: #ffffff !important;
        }

        .dark-theme strong {
            color: #ffffff !important;
        }

        .dark-theme .form-select,
        .dark-theme .form-control {
            background-color: #1e1e1e;
            color: #e0e0e0;
            border-color: #333;
        }

        .dark-theme .text-dark {
            color: #e0e0e0 !important;
        }

        .spotlight-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
            background: #000000;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .dark-theme .spotlight-overlay {
            opacity: 1;
        }

        .product-card {
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
<div class="position-fixed top-0 end-0 p-3" style="z-index:10000">
    <div class="btn-group">
        <button class="btn btn-outline-primary active" onclick="setTheme('light')">Светлая</button>
        <button class="btn btn-outline-primary" onclick="setTheme('dark')">Темная</button>
    </div>
</div>

<div class="spotlight-overlay" id="spotlightOverlay"></div>

<div class="container mt-4">
    <nav class="mb-4">
        <a href="{{ route('home') }}" class="btn btn-outline-primary">Главная</a>
        <a href="{{ route('clothes.index') }}" class="btn btn-outline-primary">Каталог</a>
        <a href="{{ route('about') }}" class="btn btn-outline-info">О магазине</a>
    @auth
            <a href="{{ route('basket.index') }}" class="btn btn-outline-success">Корзина</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary">Войти</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Регистрация</a>
        @endauth
    </nav>
    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let spotlightOverlay = document.getElementById('spotlightOverlay');

    function setTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-theme');
            document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            localStorage.setItem('theme', 'dark');
            initSpotlight();
        } else {
            document.body.classList.remove('dark-theme');
            document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            localStorage.setItem('theme', 'light');
            removeSpotlight();
        }
    }

    function initSpotlight() {
        document.addEventListener('mousemove', updateSpotlight);
        updateSpotlight({
            clientX: window.innerWidth / 2,
            clientY: window.innerHeight / 2
        });
    }

    function removeSpotlight() {
        document.removeEventListener('mousemove', updateSpotlight);
    }

    function updateSpotlight(e) {
        if (!document.body.classList.contains('dark-theme')) return;

        const x = e.clientX;
        const y = e.clientY;

        spotlightOverlay.style.background =
            `radial-gradient(circle at ${x}px ${y}px, transparent 100px, #000000 150px)`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-theme');
            initSpotlight();
            document.querySelectorAll('.btn-group .btn')[1].classList.add('active');
            document.querySelectorAll('.btn-group .btn')[0].classList.remove('active');
        }
    });
</script>
</body>
</html>
