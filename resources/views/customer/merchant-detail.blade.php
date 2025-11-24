<x-app-layout>
    @section('title', $merchant->company_name . ' - Marketplace Katering')

    <div class="space-y-6">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('customer.merchants') }}" class="hover:text-blue-600">Katering</a>
            <span>/</span>
            <span>{{ $merchant->company_name }}</span>
        </div>

        <!-- Merchant Info -->
        <div class="bg-white rounded-lg border border-gray-200 p-8">
            <div class="flex gap-6">
                <div class="text-6xl">🍽️</div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $merchant->company_name }}</h1>
                    @if($merchant->description)
                        <p class="text-gray-600 mt-2">{{ $merchant->description }}</p>
                    @endif
                    <div class="grid md:grid-cols-3 gap-4 mt-6">
                        @if($merchant->address)
                            <div>
                                <p class="text-sm text-gray-600">Alamat</p>
                                <p class="font-medium text-gray-900">{{ $merchant->address }}</p>
                            </div>
                        @endif
                        @if($merchant->phone_number)
                            <div>
                                <p class="text-sm text-gray-600">Telepon</p>
                                <p class="font-medium text-gray-900">{{ $merchant->phone_number }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-600">Menu Tersedia</p>
                            <p class="font-medium text-gray-900">{{ $merchant->menus()->count() }} item</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menus -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Menu Tersedia</h2>
            @if($merchant->menus()->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($merchant->menus() as $menu)
                        <div x-data="{ qty: 1 }" class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                            <div class="h-40 bg-gray-100 flex items-center justify-center text-4xl">🍜</div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900">{{ $menu->name }}</h3>
                                @if($menu->description)
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $menu->description }}</p>
                                @endif
                                <p class="text-lg font-bold text-blue-600 mt-3">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </p>
                                
                                <div class="flex items-center gap-2 mt-4 mb-4">
                                    <button @click="qty = Math.max(1, qty - 1)" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100 transition">−</button>
                                    <input type="number" x-model.number="qty" min="1" class="w-12 text-center border border-gray-300 rounded">
                                    <button @click="qty++" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100 transition">+</button>
                                </div>

                                <form action="{{ route('customer.cart.add') }}" method="POST" class="space-y-2">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <input type="hidden" name="quantity" x-model="qty">
                                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors py-2">
                                        Tambah ke Pesanan
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-8">Belum ada menu tersedia</p>
            @endif
        </div>
    </div>
</x-app-layout>