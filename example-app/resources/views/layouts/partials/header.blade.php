<header class="bg-white shadow">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                    BBG Catalog
                </a>
            </div>

            <!-- Include the navbar -->
            @include('layouts.partials.navbar')
        </div>
    </div>
</header>
