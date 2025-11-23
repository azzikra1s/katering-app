<!-- resources/views/welcome.blade.php -->
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50" x-data="welcome()">
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">🍽️</span>
                    </div>
                    <span class="font-bold text-xl text-slate-900">FoodHub</span>
                </div>

                <div class="hidden md:flex items-center gap-1">
                    <a href="#features" class="px-4 py-2 text-slate-600 hover:text-slate-900 transition-colors">Features</a>
                    <a href="#how-it-works" class="px-4 py-2 text-slate-600 hover:text-slate-900 transition-colors">How It Works</a>
                    <a href="#merchants" class="px-4 py-2 text-slate-600 hover:text-slate-900 transition-colors">For Merchants</a>
                </div>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-slate-600 hover:text-slate-900 transition-colors">Logout</button>
                            </form>
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-slate-600 hover:text-slate-900 transition-colors">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all">Sign Up</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-32">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl sm:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        Your Favorite Food,
                        <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Delivered Fast</span>
                    </h1>
                    <p class="text-xl text-slate-600 mb-8 leading-relaxed">
                        Order from multiple merchants, enjoy diverse cuisines, and get your meals delivered to your doorstep. Fast, easy, and delicious.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @guest
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:shadow-lg hover:shadow-orange-500/30 transition-all font-semibold text-center">
                                Order Now
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-slate-300 text-slate-900 rounded-lg hover:border-slate-400 transition-all font-semibold text-center">
                                Sign In
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:shadow-lg hover:shadow-orange-500/30 transition-all font-semibold text-center">
                                Start Ordering
                            </a>
                        @endguest
                    </div>
                </div>
                <div class="relative h-96 md:h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/20 to-red-500/20 rounded-3xl blur-3xl"></div>
                    <div class="relative bg-gradient-to-br from-orange-50 to-red-50 rounded-3xl p-8 border border-orange-200/50 h-full flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-7xl mb-4">🚀</div>
                            <p class="text-slate-600">Fresh food delivered to your door</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="bg-white py-20 border-y border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Why Choose FoodHub?</h2>
                    <p class="text-xl text-slate-600">Everything you need for a delicious experience</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-8 rounded-2xl border border-slate-200 hover:border-orange-300 hover:shadow-lg hover:shadow-orange-100 transition-all group">
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                            <span class="text-2xl">🏪</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Multiple Merchants</h3>
                        <p class="text-slate-600">Choose from hundreds of restaurants and food merchants all in one place</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 rounded-2xl border border-slate-200 hover:border-orange-300 hover:shadow-lg hover:shadow-orange-100 transition-all group">
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                            <span class="text-2xl">⚡</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Fast Delivery</h3>
                        <p class="text-slate-600">Get your orders delivered quickly with real-time tracking and updates</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 rounded-2xl border border-slate-200 hover:border-orange-300 hover:shadow-lg hover:shadow-orange-100 transition-all group">
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                            <span class="text-2xl">💳</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Secure Payment</h3>
                        <p class="text-slate-600">Safe and secure payment options for worry-free transactions</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-8 rounded-2xl border border-slate-200 hover:border-orange-300 hover:shadow-lg hover:shadow-orange-100 transition-all group">
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                            <span class="text-2xl">⭐</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Quality Assured</h3>
                        <p class="text-slate-600">All merchants are verified for quality and hygiene standards</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="p-8 rounded-2xl border border-slate-200 hover:border-orange-300 hover:shadow-lg hover:shadow-orange-100 transition-all group">
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                            <span class="text-2xl">📱</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Easy to Use</h3>
                        <p class="text-slate-600">Intuitive interface makes ordering simple and enjoyable</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="p-8 rounded-2xl border border-slate-200 hover:border-orange-300 hover:shadow-lg hover:shadow-orange-100 transition-all group">
                        <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                            <span class="text-2xl">🎁</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Special Offers</h3>
                        <p class="text-slate-600">Exclusive deals and discounts for loyal customers</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">How It Works</h2>
                    <p class="text-xl text-slate-600">Three simple steps to get your food</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-orange-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                            1
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Browse Merchants</h3>
                        <p class="text-slate-600 mb-6">Explore our collection of verified merchants and their delicious menus</p>
                        <div class="h-1 w-8 bg-orange-300 mx-auto"></div>
                    </div>

                    <div class="text-center">
                        <div class="w-20 h-20 bg-orange-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                            2
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Add to Cart</h3>
                        <p class="text-slate-600 mb-6">Select your favorite dishes and customize them to your taste</p>
                        <div class="h-1 w-8 bg-orange-300 mx-auto"></div>
                    </div>

                    <div class="text-center">
                        <div class="w-20 h-20 bg-orange-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                            3
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Checkout & Enjoy</h3>
                        <p class="text-slate-600 mb-6">Complete your order and wait for your delicious meal to arrive</p>
                        <div class="h-1 w-8 bg-orange-300 mx-auto"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- For Merchants Section -->
        <section id="merchants" class="bg-gradient-to-br from-slate-900 to-slate-800 py-20 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold mb-6">Grow Your Business with FoodHub</h2>
                        <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                            Join thousands of successful merchants who are growing their food business with our platform. Reach more customers, manage orders efficiently, and increase your revenue.
                        </p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3">
                                <span class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">✓</span>
                                <span>Easy order management system</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">✓</span>
                                <span>Detailed sales analytics and reports</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">✓</span>
                                <span>Zero commission on first 100 orders</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">✓</span>
                                <span>24/7 dedicated support</span>
                            </li>
                        </ul>
                        @guest
                            <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-semibold">
                                Become a Merchant
                            </a>
                        @endguest
                    </div>
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-red-500/10 rounded-3xl blur-3xl"></div>
                        <div class="relative bg-slate-800/50 border border-slate-700 rounded-3xl p-8 text-center backdrop-blur">
                            <div class="text-7xl mb-4">📊</div>
                            <p class="text-slate-300">Manage your restaurant with ease</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-slate-900 mb-6">Ready to Get Started?</h2>
                <p class="text-xl text-slate-600 mb-12">Join thousands of happy customers and merchants on FoodHub today</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:shadow-lg hover:shadow-orange-500/30 transition-all font-semibold">
                            Sign Up as Customer
                        </a>
                        <a href="{{ route('register') }}" class="px-8 py-4 border-2 border-orange-500 text-orange-500 rounded-lg hover:bg-orange-50 transition-all font-semibold">
                            Become a Merchant
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:shadow-lg hover:shadow-orange-500/30 transition-all font-semibold">
                            Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <h4 class="text-white font-semibold mb-4">For Customers</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Browse Food</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Track Orders</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">My Account</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">For Merchants</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Partner With Us</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Merchant Dashboard</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Support</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Company</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Terms & Conditions</a></li>
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
        function welcome() {
            return {
                init() {
                    // Smooth scroll behavior
                    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                        anchor.addEventListener('click', (e) => {
                            if (anchor.getAttribute('href') !== '#') {
                                e.preventDefault();
                                const target = document.querySelector(anchor.getAttribute('href'));
                                if (target) {
                                    target.scrollIntoView({ behavior: 'smooth' });
                                }
                            }
                        });
                    });
                },
            }
        }
    </script>
</x-guest-layout>