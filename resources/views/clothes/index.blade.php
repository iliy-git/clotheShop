@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-center">Каталог одежды</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Фильтры</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('clothes.index') }}">
                        <div class="mb-3">
                            <label class="form-label">Категория</label>
                            <select name="category" class="form-select">
                                <option value="all">Все категории</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Размер</label>
                            <select name="size" class="form-select">
                                <option value="all">Все размеры</option>
                                @foreach($sizes as $s)
                                    <option value="{{ $s }}" {{ $size == $s ? 'selected' : '' }}>
                                        {{ $s }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Сортировка</label>
                            <select name="sort" class="form-select">
                                <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Сначала новые</option>
                                <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Цена ↑</option>
                                <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Цена ↓</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Применить</button>
                        <a href="{{ route('clothes.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            Сбросить
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            @if($clothes->count() > 0)
                <div class="row">
                    @foreach($clothes as $clothe)
                        <div class="col-sm-6 col-lg-4 mb-4">
                            <div class="card h-100 product-card shadow-sm">
                                @if($clothe->has_image)
                                    <img src="{{ $clothe->image_url }}" class="card-img-top" alt="{{ $clothe->name }}"
                                         style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                         style="height: 250px;">
                                        <span class="text-muted">Нет изображения</span>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        <a href="{{ route('clothes.show', $clothe) }}"
                                           class="text-decoration-none text-dark">
                                            {{ $clothe->name }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted small">{{ Str::limit($clothe->description, 80) }}</p>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="h5 text-primary mb-0">{{ number_format($clothe->price, 0, ',', ' ') }} ₽</span>
                                            <span class="badge bg-secondary">{{ $clothe->size }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Цвет: {{ $clothe->color }}</small>
                                            <small class="text-muted">{{ $clothe->stock }} шт.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <strong>В наличии:</strong>
                                    @if($clothe->available_stock > 0)
                                        <span class="text-success">{{ $clothe->available_stock }} шт.</span>
                                        @if($clothe->available_stock < $clothe->stock)
                                            <small class="text-warning d-block">(часть товара в корзинах других
                                                пользователей)</small>
                                        @endif
                                    @else
                                        <span class="text-danger">Нет в наличии</span>
                                    @endif
                                </div>

                                @if($clothe->available_stock > 0)
                                    @auth
                                        @if($clothe->can_add_to_basket)
                                            <form action="{{ route('basket.add', $clothe) }}" method="POST"
                                                  class="mb-4">
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
                                                        <button type="submit" class="btn btn-success btn-lg">Добавить в
                                                            корзину
                                                        </button>
                                                    </div>
                                                </div>
                                                @if($clothe->max_available_quantity < $clothe->available_stock)
                                                    <small class="text-warning d-block mt-2">
                                                        Максимум {{ $clothe->max_available_quantity }} шт. доступно для
                                                        вас
                                                    </small>
                                                @endif
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-lg" disabled>Вы уже добавили
                                                максимальное количество
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Войдите чтобы
                                            купить</a>
                                    @endauth
                                @else
                                    <button class="btn btn-secondary btn-lg" disabled>Нет в наличии</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($clothes->count() > 12)
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            @if ($clothes->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Назад</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $clothes->previousPageUrl() }}" rel="prev">Назад</a>
                                </li>
                            @endif
                            @foreach ($clothes->getUrlRange(1, $clothes->lastPage()) as $page => $url)
                                @if ($page == $clothes->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($clothes->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $clothes->nextPageUrl() }}" rel="next">Вперед</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Вперед</span>
                                </li>
                            @endif
                        </ul>

                        <div class="text-center text-muted mt-2">
                            Показано с {{ $clothes->firstItem() }} по {{ $clothes->lastItem() }}
                            из {{ $clothes->total() }} товаров
                        </div>
                    </nav>
                @endif
            @else
                <div class="alert alert-info text-center py-5">
                    <h4>Товары не найдены</h4>
                    <p class="mb-0">Попробуйте изменить параметры фильтрации</p>
                </div>
            @endif
        </div>
@endsection
