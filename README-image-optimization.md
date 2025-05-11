# Оптимізація зображень для адаптивного дизайну

## Встановлення

1. Встановіть пакет Intervention/Image для обробки зображень:

```bash
composer require intervention/image
```

2. Опублікуйте конфігурацію (опціонально):

```bash
php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
```

## Структура директорій

Для адаптивних зображень використовуються такі директорії:

```
public/images/backgrounds/
public/images/backgrounds/mobile/
public/images/backgrounds/tablet/

public/images/services/
public/images/services/mobile/
public/images/services/tablet/

storage/app/public/images/
storage/app/public/images/mobile/
storage/app/public/images/tablet/

storage/app/public/images/avatars/
storage/app/public/images/avatars/small/
```

## Генерація адаптивних зображень

Для генерації адаптивних версій зображень використовуйте команду:

```bash
php artisan images:responsive
```

Для примусової регенерації всіх зображень:

```bash
php artisan images:responsive --force
```

## Використання в шаблонах

### Для звичайних зображень

```html
<picture>
    <!-- Мобільні пристрої -->
    <source media="(max-width: 640px)" srcset="{{ asset('storage/images/mobile/' . basename($image)) }}">
    <!-- Планшети -->
    <source media="(max-width: 1024px)" srcset="{{ asset('storage/images/tablet/' . basename($image)) }}">
    <!-- Десктопи -->
    <img src="{{ asset($image) }}" alt="{{ $alt }}" class="adaptive-img" loading="lazy">
</picture>
```

### Для фонових зображень

```html
<div class="services-bg">
    <!-- CSS автоматично підбере правильне зображення залежно від розміру екрану -->
</div>
```

## CSS класи

Для адаптивних зображень використовуйте такі класи:

- `adaptive-img` - базовий клас для адаптивних зображень
- `adaptive-img-container` - контейнер для адаптивних зображень
- `adaptive-img-sm` - для мобільних пристроїв
- `adaptive-img-md` - для планшетів
- `adaptive-img-lg` - для десктопів

## Оптимізація розміру файлів

Для додаткової оптимізації розміру файлів рекомендується використовувати формат WebP:

```bash
# Встановлення WebP утиліт на Ubuntu/Debian
sudo apt-get install webp

# Конвертація зображень
cwebp -q 80 input.jpg -o output.webp
```

Або використовуйте онлайн-сервіси для оптимізації зображень, такі як:
- [TinyPNG](https://tinypng.com/)
- [Squoosh](https://squoosh.app/)
- [Compressor.io](https://compressor.io/)
