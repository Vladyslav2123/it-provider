<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($reviews as $review)
        <div class="cyber-card p-6 rounded-lg">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 mr-3">
                    @if($review->avatar)
                        <picture>
                            <!-- Мобільні пристрої -->
                            <source media="(max-width: 640px)" srcset="{{ asset('storage/images/avatars/small/' . basename($review->avatar)) }}">
                            <!-- Десктопи -->
                            <img class="h-10 w-10 rounded-full border border-gray-500" src="{{ $review->avatar }}"
                                 alt="{{ $review->name }}" loading="lazy">
                        </picture>
                    @else
                        <div
                            class="h-10 w-10 rounded-full bg-gray-800 border border-gray-500 flex items-center justify-center">
                            <span class="text-gray-500 font-semibold">{{ substr($review->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div>
                    <h4 class="text-lg font-semibold cyber-text">{{ $review->name }}</h4>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-gray-300' : 'text-gray-600' }}"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                </div>
            </div>
            <p class="cyber-text">{{ $review->content }}</p>
            <div class="mt-4 text-sm cyber-text opacity-70">
                {{ $review->created_at->diffForHumans() }}
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="cyber-text text-lg">Ще немає відгуків. Будьте першим, хто залишить відгук!</p>
        </div>
    @endforelse
</div>
