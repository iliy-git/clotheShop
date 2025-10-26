@extends('layouts.app')

@section('title', 'О магазине')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">О нашем магазине</h4>
                </div>
                <div class="card-body">
                    <p>Мы продаем качественную одежду с 2010 года. Наша миссия - помогать людям выглядеть стильно и чувствовать себя уверенно.</p>
                    <p>Все товары проходят строгий контроль качества. Мы работаем только с проверенными поставщиками.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Контакты</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Телефон владельца:</strong><br>
                        <a href="tel:+79991234567">+7 (111) 111-11-11</a>
                    </div>

                    <div class="mb-3">
                        <strong>Email владельца:</strong><br>
                        <a href="#">stepkindanil@gmail.ru</a>
                    </div>

                    <div class="mb-3">
                        <strong>Адрес:</strong><br>
                        площадь Ростовского Стрелкового Полка Народного Ополчения, 2
                    </div>

                    <div>
                        <strong>Режим работы:</strong><br>
                        Пн-Пт: 10:00-20:00<br>
                        Сб-Вс: 11:00-19:00
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
