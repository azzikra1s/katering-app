<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FoodHub')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="sticky top-0 z-40 bg-white border-b border-slate-200" x-data="navigation()">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">🍽️</span>
                        </div>
                        <span class="font-bold text-xl text-slate-900">FoodHub</span>
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-8">
                        @auth
                            @if(auth()->user()->role === 'customer')
                                <a href="{{ route('customer.dashboard') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Home</a>
                                <a href="{{ route('customer.merchants') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Merchants</a>
                                <a href="{{ route('customer.cart') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Cart</a>
                                <a href="{{ route('customer.orders') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Orders</a>
                            @else
                                <a href="{{ route('merchant.dashboard') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Dashboard</a>
                                <a href="{{ route('merchant.menus.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Menus</a>
                                <a href="{{ route('merchant.orders') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Orders</a>
                            @endif
                        @endauth
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center gap-4">
                        @auth
                            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-100 transition-colors">
                                    <span class="text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-slate-700 hover:bg-slate-50 transition-colors first:rounded-t-lg">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-200">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-slate-700 hover:bg-slate-50 transition-colors last:rounded-b-lg">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900 transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all">Sign Up</a>
                        @endauth

                        <!-- Mobile Menu Button -->
                        <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 hover:bg-slate-100 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="mobileOpen" x-transition class="md:hidden border-t border-slate-200 py-4 space-y-2">
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <a href="{{ route('customer.dashboard') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg">Home</a>
                            <a href="{{ route('customer.merchants') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg">Merchants</a>
                            <a href="{{ route('customer.cart') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg">Cart</a>
                            <a href="{{ route('customer.orders') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg">Orders</a>
                        @else
                            <a href="{{ route('merchant.dashboard') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg">Dashboard</a>
                            <a href="{{ route('merchant.menus.index') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg">Menus</a>
                            <a href="{{ route('merchant.orders') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg">Orders</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if ($errors->any())
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4">
                <div class="rounded-lg bg-red-50 border border-red-200 p-4">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4" x-data="{ show: true }" x-show="show" x-transition>
                <div class="rounded-lg bg-green-50 border border-green-200 p-4">
                    <div class="flex gap-3 items-start">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-green-600 hover:text-green-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">🍽️</span>
                            </div>
                            <span class="font-bold text-white">FoodHub</span>
                        </div>
                        <p class="text-sm">Delivering happiness, one meal at a time</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Support</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Follow Us</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Facebook</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Instagram</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Twitter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-8 text-center text-sm">
                    <p>&copy; 2024 FoodHub. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function navigation() {
            return {
                mobileOpen: false,
            }
        }
    </script>
</body>
</html>