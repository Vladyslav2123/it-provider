<?php

namespace Database\Seeders;

use App\Models\CoverageArea;
use App\Models\Review;
use App\Models\Service;
use App\Models\SliderItem;
use App\Models\Tariff;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Створення адміністратора
        User::create([
            'name' => 'Адміністратор',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Створення слайдерів
        SliderItem::create([
            'title' => 'Надшвидкісний оптоволоконний інтернет',
            'description' => 'Відчуйте швидкість до 2 Гбіт/с з нашою оптоволоконною мережею нового покоління. Ідеально підходить для стрімінгу, ігор та роботи з дому.',
            'image' => '/images/backgrounds/coverage-bg.jpg',
            'button_text' => 'Переглянути тарифи',
            'button_url' => '#tariffs',
            'order' => 1,
            'active' => true,
        ]);

        SliderItem::create([
            'title' => 'Рішення для бізнесу',
            'description' => 'Індивідуальні пакети підключення для бізнесу з цілодобовою підтримкою та гарантією доступності 99,9%.',
            'image' => '/images/backgrounds/coverage-bg.jpg',
            'button_text' => 'Бізнес-тарифи',
            'button_url' => '#services',
            'order' => 2,
            'active' => true,
        ]);

        SliderItem::create([
            'title' => 'Обмежена пропозиція',
            'description' => 'Підключіться сьогодні та отримайте безкоштовне встановлення плюс перший місяць безкоштовно на будь-якому тарифі.',
            'image' => '/images/backgrounds/coverage-bg.jpg',
            'button_text' => 'Отримати пропозицію',
            'button_url' => '#tariffs',
            'order' => 3,
            'active' => true,
        ]);

        // Створення послуг
        Service::create([
            'title' => 'Оптоволоконний інтернет',
            'description' => 'Відчуйте блискавично швидке з\'єднання з нашою найсучаснішою оптоволоконною мережею. Насолоджуйтесь швидкістю до 2 Гбіт/с з наднизькою затримкою, ідеально для стрімінгу 4K, кіберспорту та відеоконференцій без перебоїв.',
            'icon' => '/images/icons/fiber.svg',
            'image' => '/images/backgrounds/hero-bg.png',
            'order' => 1,
            'active' => true,
        ]);

        Service::create([
            'title' => 'Рішення для бізнесу',
            'description' => 'Індивідуальні рішення підключення для бізнесу будь-якого розміру. Наш корпоративний сервіс включає виділену пропускну здатність, гарантію доступності 99,9%, цілодобову пріоритетну підтримку та розширені функції безпеки для безперебійної роботи вашого бізнесу.',
            'icon' => '/images/icons/business.svg',
            'image' => '/images/backgrounds/services-bg.png',
            'order' => 2,
            'active' => true,
        ]);

        Service::create([
            'title' => 'Wi-Fi для розумного дому',
            'description' => 'Усуньте мертві зони з нашою передовою mesh Wi-Fi системою. Підключіть усі пристрої розумного дому з безперебійним покриттям по всьому будинку. Включає просте налаштування, батьківський контроль та можливості гостьової мережі.',
            'icon' => '/images/icons/wifi.svg',
            'image' => '/images/backgrounds/tariffs-bg.png',
            'order' => 3,
            'active' => true,
        ]);

        Service::create([
            'title' => 'IPTV та стрімінг',
            'description' => 'Отримайте доступ до сотень телеканалів та преміум стрімінгових сервісів з нашим інтегрованим IPTV рішенням. Насолоджуйтесь кришталево чистим HD та 4K контентом на кількох пристроях одночасно без буферизації.',
            'icon' => '/images/icons/tv.svg',
            'image' => '/images/backgrounds/coverage-bg.png',
            'order' => 4,
            'active' => true,
        ]);

        // Створення тарифів
        Tariff::create([
            'name' => 'Базовий',
            'description' => 'Доступне підключення для базового перегляду сторінок, електронної пошти та соціальних мереж. Ідеально для окремих осіб або невеликих домогосподарств з легким використанням інтернету.',
            'price' => 34.99,
            'speed' => '200 Мбіт/с',
            'period' => 'місяць',
            'is_popular' => false,
            'active' => true,
            'order' => 1,
        ]);

        Tariff::create([
            'name' => 'Сімейний Плюс',
            'description' => 'Ідеально для сімей з кількома пристроями. Дивіться HD-контент, грайте в онлайн-ігри та працюйте з дому без перерв.',
            'price' => 59.99,
            'speed' => '600 Мбіт/с',
            'period' => 'місяць',
            'is_popular' => true,
            'active' => true,
            'order' => 2,
        ]);

        Tariff::create([
            'name' => 'Ультра',
            'description' => 'Наш преміум-план з блискавичною швидкістю для досвідчених користувачів. Ідеально для стрімінгу 4K, кіберспорту та великих домогосподарств з багатьма підключеними пристроями.',
            'price' => 89.99,
            'speed' => '1.5 Гбіт/с',
            'period' => 'місяць',
            'is_popular' => false,
            'active' => true,
            'order' => 3,
        ]);

        Tariff::create([
            'name' => 'Про Геймер',
            'description' => 'Розроблений для серйозних геймерів з найнижчою можливою затримкою та пріоритетною маршрутизацією. Включає статичну IP-адресу та розширений QoS для безперервних ігрових сесій.',
            'price' => 99.99,
            'speed' => '2 Гбіт/с',
            'period' => 'місяць',
            'is_popular' => false,
            'active' => true,
            'order' => 4,
        ]);

        Tariff::create([
            'name' => 'Бізнес Базовий',
            'description' => 'Надійне підключення для малого бізнесу з кількістю працівників до 10 осіб. Включає маршрутизатор бізнес-класу та базову угоду про рівень обслуговування.',
            'price' => 129.99,
            'speed' => '500 Мбіт/с',
            'period' => 'місяць',
            'is_popular' => false,
            'active' => true,
            'order' => 5,
        ]);

        // Створення відгуків
        Review::create([
            'name' => 'Ярослав Вільчинський',
            'email' => 'yaroslav@example.com',
            'content' => 'Просто вражений швидкістю! Я можу завантажувати великі файли за секунди та дивитися 4K контент на кількох пристроях одночасно без будь-якої буферизації.',
            'rating' => 5,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Олена Петренко',
            'email' => 'olena@example.com',
            'content' => 'Команда обслуговування клієнтів виняткова. Коли у мене виникла проблема з маршрутизатором, вони надіслали техніка того ж дня, який все виправив і навіть оптимізував налаштування моєї домашньої мережі.',
            'rating' => 5,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Дмитро Чернишов',
            'email' => 'dmytro@example.com',
            'content' => 'Як віддалений розробник програмного забезпечення, надійний інтернет є вирішальним для моєї роботи. Після переходу до цього провайдера я не мав жодного збою понад 8 місяців. Варто кожної копійки!',
            'rating' => 5,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Софія Романенко',
            'email' => 'sofia@example.com',
            'content' => 'Встановлення було швидким і професійним. Технік чітко все пояснив і допоміг налаштувати мою Wi-Fi мережу для оптимального покриття по всьому будинку.',
            'rating' => 4,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Роман Тищенко',
            'email' => 'roman@example.com',
            'content' => 'Моя сім\'я з п\'яти осіб одночасно дивиться стрімінг, грає в ігри та працює з дому без будь-яких проблем. Тариф "Сімейний Плюс" ідеально підходить для наших потреб, а ціна розумна порівняно з іншими провайдерами.',
            'rating' => 5,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Марія Коваленко',
            'email' => 'maria@example.com',
            'content' => 'Перейшла від іншого провайдера і різниця просто вражаюча. Швидкість завжди стабільна, навіть у години пік. Дуже задоволена сервісом і ціною.',
            'rating' => 5,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Андрій Мельник',
            'email' => 'andriy@example.com',
            'content' => 'Як геймер, я дуже вимогливий до швидкості інтернету та пінгу. Цей провайдер перевершив усі мої очікування. Затримка мінімальна, а швидкість завантаження просто вражає.',
            'rating' => 5,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Наталія Шевченко',
            'email' => 'natalia@example.com',
            'content' => 'Працюю віддалено і потребую надійного інтернету для відеоконференцій. З цим провайдером у мене не було жодних проблем. Відмінний сервіс!',
            'rating' => 4,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Віктор Бондаренко',
            'email' => 'viktor@example.com',
            'content' => 'Підключився місяць тому і дуже задоволений. Швидкість відповідає заявленій, а технічна підтримка працює оперативно. Рекомендую!',
            'rating' => 5,
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Ірина Ковальчук',
            'email' => 'iryna@example.com',
            'content' => 'Дуже задоволена якістю обслуговування. Коли виникла проблема з роутером, спеціаліст приїхав того ж дня і все налаштував. Дякую за професіоналізм!',
            'rating' => 5,
            'approved' => true,
        ]);

        // Створення зон покриття
        CoverageArea::create([
            'name' => 'Центр Києва',
            'city' => 'Київ',
            'region' => 'Київська область',
            'postal_code' => '01001',
            'latitude' => 50.4501,
            'longitude' => 30.5234,
            'radius' => 5.0,
            'description' => 'Повне покриття в центрі міста з оптоволоконними з\'єднаннями.',
            'active' => true,
        ]);

        CoverageArea::create([
            'name' => 'Оболонський район',
            'city' => 'Київ',
            'region' => 'Київська область',
            'postal_code' => '04205',
            'latitude' => 50.5101,
            'longitude' => 30.4973,
            'radius' => 4.0,
            'description' => 'Високошвидкісний інтернет доступний по всьому Оболонському району.',
            'active' => true,
        ]);

        CoverageArea::create([
            'name' => 'Центр Львова',
            'city' => 'Львів',
            'region' => 'Львівська область',
            'postal_code' => '79000',
            'latitude' => 49.8397,
            'longitude' => 24.0297,
            'radius' => 3.5,
            'description' => 'Сервіс доступний у центральному Львові зі швидкістю до 1 Гбіт/с.',
            'active' => true,
        ]);

        CoverageArea::create([
            'name' => 'Приморський район Одеси',
            'city' => 'Одеса',
            'region' => 'Одеська область',
            'postal_code' => '65000',
            'latitude' => 46.4825,
            'longitude' => 30.7233,
            'radius' => 4.2,
            'description' => 'Покриття по всьому Приморському району з надійними з\'єднаннями.',
            'active' => true,
        ]);
    }
}
