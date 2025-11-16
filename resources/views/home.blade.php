@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="row">
        <div class="col-12">
                <div class="bg-primary text-white p-5 rounded mb-4">
                <div class="d-flex justify-content-center p-2">
                    <h1 class=""><strong>ClotheShop</strong></h1>
                </div>
                <h1 class="display-4">Добро пожаловать в магазин одежды </h1>
                <p class="lead">Стильная одежда для каждого дня. Качество, комфорт и доступные цены.</p>
                <hr class="my-4">
                <p>Откройте для себя новые коллекции и выгодные предложения.</p>
                <a class="btn btn-light btn-lg" href="{{ route('clothes.index') }}" role="button">Перейти к покупкам</a>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Новые поступления</h4>
                </div>
                <div class="card-body">
                    <p>В нашем магазине регулярно появляются новые коллекции одежды. Следите за обновлениями!</p>
                    <a href="{{ route('clothes.index') }}" class="btn btn-outline-primary">Смотреть каталог</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Акции и скидки</h4>
                </div>
                <div class="card-body">
                    <p>Специальные предложения для наших постоянных клиентов. Не упустите выгоду!</p>
                    <a href="{{ route('clothes.index') }}" class="btn btn-outline-primary">Узнать больше</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Почему выбирают нас?</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-tshirt fa-2x"></i>
                            </div>
                            <h6>Качественные материалы</h6>
                            <p class="small">Только натуральные ткани и современные технологии</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-truck fa-2x"></i>
                            </div>
                            <h6>Быстрая доставка</h6>
                            <p class="small">Доставляем заказы по всему городу в течение дня</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-undo-alt fa-2x"></i>
                            </div>
                            <h6>Легкий возврат</h6>
                            <p class="small">Возврат товара в течение 14 дней без вопросов</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-headset fa-2x"></i>
                            </div>
                            <h6>Поддержка 24/7</h6>
                            <p class="small">Всегда готовы помочь с выбором и ответить на вопросы</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
