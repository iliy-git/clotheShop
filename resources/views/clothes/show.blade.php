@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            @if($clothe->has_image)
                <img src="{{ $clothe->image_url }}" class="img-fluid rounded shadow" alt="{{ $clothe->name }}">
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                    <span class="text-muted">Нет изображения</span>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <h1 class="mb-3">{{ $clothe->name }}</h1>
            <p class="text-muted mb-3">Категория: {{ $clothe->category }}</p>

            <div class="mb-4">
                <span class="h2 text-primary">{{ number_format($clothe->price, 0, ',', ' ') }} ₽</span>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <strong>Размер:</strong><br>
                    <span class="badge bg-secondary fs-6">{{ $clothe->size }}</span>
                </div>
                <div class="col-6">
                    <strong>Цвет:</strong><br>
                    {{ $clothe->color }}
                </div>
            </div>

            <div class="mb-4">
                <strong>В наличии:</strong>
                @if($clothe->available_stock > 0)
                    <span class="text-success">{{ $clothe->available_stock }} шт.</span>
                    @if($clothe->available_stock < $clothe->stock)
                        <small class="text-warning d-block mt-1">(часть товара в корзинах других пользователей)</small>
                    @endif
                @else
                    <span class="text-danger">Нет в наличии</span>
                @endif
            </div>

            @if($clothe->available_stock > 0)
                @auth
                    @if($clothe->can_add_to_basket)
                        <form action="{{ route('basket.add', $clothe) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    <label for="quantity" class="col-form-label">Количество:</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number"
                                           name="quantity"
                                           id="quantity"
                                           value="1"
                                           min="1"
                                           max="{{ $clothe->max_available_quantity }}"
                                           class="form-control"
                                           style="width: 100px;">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success btn-lg">Добавить в корзину</button>
                                </div>
                            </div>
                            @if($clothe->max_available_quantity < $clothe->available_stock)
                                <small class="text-warning d-block mt-2">
                                    Максимум {{ $clothe->max_available_quantity }} шт. доступно для вас
                                </small>
                            @endif
                        </form>
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>Вы уже добавили максимальное количество</button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Войдите чтобы купить</a>
                @endauth
            @else
                <button class="btn btn-secondary btn-lg" disabled>Нет в наличии</button>
            @endif

            <div class="mt-5">
                <h4>Описание</h4>
                <p class="fs-5">{{ $clothe->description }}</p>
            </div>
        </div>
    </div>

    @if($relatedClothes->count() > 0)
        <div class="mt-5 pt-4 border-top">
            <h3 class="mb-4">Похожие товары</h3>
            <div class="row">
                @foreach($relatedClothes as $related)
                    <div class="col-md-3 col-6 mb-3">
                        <div class="card h-100">
                            @if($related->has_image)
                                <img src="{{ $related->image_url }}" class="card-img-top" alt="{{ $related->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">Нет изображения</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <h6 class="card-title">
                                    <a href="{{ route('clothes.show', $related) }}" class="text-decoration-none text-dark">
                                        {{ Str::limit($related->name, 30) }}
                                    </a>
                                </h6>
                                <p class="card-text text-primary mb-1">{{ number_format($related->price, 0, ',', ' ') }} ₽</p>
                                <small class="text-muted">{{ $related->size }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
