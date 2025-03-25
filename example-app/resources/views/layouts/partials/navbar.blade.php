<nav class="hidden md:flex space-x-8">
    <a href="{{ route('home') }}" class="text-gray-800 hover:text-blue-600 font-medium">Home</a>
    <a href="{{ route('products.index') }}" class="text-gray-800 hover:text-blue-600 font-medium">Products</a>

    <!-- Categories dropdown -->
    <div class="relative group">
        <button class="text-gray-800 hover:text-blue-600 font-medium flex items-center" id="categories-menu-button">
            Categories
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
            <!-- Categories will be dynamically populated -->
            @foreach($categories ?? [] as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Optional: Search button -->
    <a href="#" class="text-gray-800 hover:text-blue-600 font-medium">Search</a>

    <!-- Optional: Cart button (if implementing shopping cart) -->
    <a href="{{ route('cart.index') }}" class="text-gray-800 hover:text-blue-600 font-medium flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z" />
            <path d="M16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>
        Cart
    </a>
</nav>

<!-- Mobile menu button -->
<div class="md:hidden">
    <button type="button" id="mobile-menu-button" class="text-gray-500 hover:text-gray-600 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- Mobile menu -->
<div id="mobile-menu" class="hidden md:hidden absolute top-16 right-4 left-4 bg-white shadow-md rounded-md py-2 z-20">
    <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Home</a>
    <a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Products</a>

    <!-- Categories submenu for mobile -->
    <div class="px-4 py-2">
        <button id="mobile-categories-button" class="flex items-center justify-between w-full text-gray-800">
            Categories
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <div id="mobile-categories-menu" class="hidden pl-4 pt-2">
            @foreach($categories ?? [] as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="block py-2 text-gray-700">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Search</a>
    <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Cart</a>
</div>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Toggle categories submenu on mobile
    document.getElementById('mobile-categories-button')?.addEventListener('click', function() {
        const submenu = document.getElementById('mobile-categories-menu');
        submenu.classList.toggle('hidden');
    });
</script>
