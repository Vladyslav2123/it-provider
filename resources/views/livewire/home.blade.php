<div>
    <!-- Hero Section with Slider -->
    <section id="home" class="relative">
        <livewire:slider :items="$sliderItems"/>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 relative cyber-section services-bg">
        <div class="relative z-10">
            <livewire:services/>
        </div>
    </section>

    <!-- Tariffs Section -->
    <section id="tariffs" class="py-16 relative cyber-section tariffs-bg">
        <div class="relative z-10">
            <livewire:tariffs/>
        </div>
    </section>

    <!-- Coverage Map Section -->
    <section id="coverage" class="py-16 relative cyber-section coverage-bg">
        <div class="relative z-10">
            <livewire:coverage-map/>
        </div>
    </section>

    <!-- Reviews Section -->
    <section id="reviews" class="py-16 relative cyber-section reviews-bg">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold cyber-heading sm:text-4xl text-center">Що кажуть наші клієнти</h2>
            <p class="mt-4 text-lg cyber-text mb-5 text-center">Не вірте нам на слово - послухайте наших задоволених
                клієнтів.</p>
            <livewire:reviews/>

            <div class="mt-12 pt-8 border-t dark:border-gray-700">
                <h3 class="text-2xl font-bold cyber-heading mb-6 text-center">Залишити відгук</h3>
                <livewire:review-form/>
            </div>
        </div>
    </section>
</div>
