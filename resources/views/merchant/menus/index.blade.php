<x-app-layout>
    @section('title', 'Kelola Menu - Marketplace Katering')

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Kelola Menu</h1>
            <a href="{{ route('merchant.menus.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                + Tambah Menu
            </a>
        </div>

        @if($menus->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($menus as $menu)
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="h-40 bg-gray-100 flex items-center justify-center text-4xl">🍜</div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900">{{ $menu->name }}</h3>
                            @if($menu->description)
                                <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $menu->description }}</p>
                            @endif
                            <p class="text-lg font-bold text-blue-600 mt-3">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                            
                            <div class="flex gap-2 mt-4">
                                <a href="#edit" class="flex-1 text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                                    Edit
                                </a>
                                <form action="#delete" method="POST" class="flex-1" onsubmit="return confirm('Hapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
                <p class="text-gray-600 mb-4">Belum ada menu</p>
                <a href="{{ route('merchant.menus.create') }}" class="text-blue-600 hover:text-blue-700 font-medium">Tambah menu pertama Anda</a>
            </div>
        @endif
    </div>
</x-app-layout>