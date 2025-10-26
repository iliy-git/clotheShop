@extends('layouts.app')

@section('content')
    <style>
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .quantity-input {
            width: 70px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
    <h1 class="mb-4">Корзина</h1>

    @if($basketItems->count() > 0)
        <div class="row">
            <div class="col-md-8">
                @foreach($basketItems as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    @if($item->clothe->has_image)
                                        <img src="{{ $item->clothe->image_url }}"
                                             class="product-image"
                                             alt="{{ $item->clothe->name }}"
                                             onerror="this.src='https://via.placeholder.com/80x80/cccccc/969696?text=Нет+фото'">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center product-image">
                                            <span class="text-muted small">Нет фото</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <h6 class="card-title mb-1">{{ $item->clothe->name }}</h6>
                                    <p class="text-muted mb-1 small">Размер: {{ $item->clothe->size }}</p>
                                    <p class="text-muted mb-0 small">Цвет: {{ $item->clothe->color }}</p>
                                    <p class="text-muted small mb-0">Цена: {{ number_format($item->clothe->price, 0, ',', ' ') }} ₽/шт</p>
                                </div>

                                <div class="col-md-3">
                                    <form action="{{ route('basket.update', $item) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number"
                                               name="quantity"
                                               value="{{ $item->quantity }}"
                                               min="1"
                                               max="{{ $item->clothe->stock }}"
                                               class="form-control form-control-sm quantity-input me-2">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Обновить</button>
                                    </form>
                                </div>

                                <div class="col-md-2 text-center">
                                    <span class="h6 text-primary d-block">{{ number_format($item->clothe->price * $item->quantity, 0, ',', ' ') }} ₽</span>
                                    <small class="text-muted">{{ $item->quantity }} × {{ number_format($item->clothe->price, 0, ',', ' ') }} ₽</small>
                                </div>

                                <div class="col-md-1 text-center">
                                    <form action="{{ route('basket.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить">×</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Итого</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Товары:</span>
                            <span>{{ $basketItems->sum('quantity') }} шт.</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Сумма:</span>
                            <span>{{ number_format($total, 0, ',', ' ') }} ₽</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Общая сумма:</strong>
                            <strong class="h5 text-primary">{{ number_format($total, 0, ',', ' ') }} ₽</strong>
                        </div>
                        <button class="btn btn-success w-100 btn-lg" disabled>Оформить заказ</button>
                        <a href="{{ route('clothes.index') }}" class="btn btn-outline-primary w-100 mt-2">
                            Продолжить покупки
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="card shadow-sm">
                <div class="card-body py-5">
                    <h3 class="text-muted mb-3">Корзина пуста</h3>
                    <p class="text-muted mb-4">Добавьте товары из каталога</p>
                    <a href="{{ route('clothes.index') }}" class="btn btn-primary btn-lg">Перейти в каталог</a>
                </div>
            </div>
        </div>
    @endif
@endsection
