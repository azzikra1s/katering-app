<!-- resources/views/merchant/menus/index.blade.php -->
@extends('layouts.app')

@section('title', 'Menus - FoodHub Merchant')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Menu Management</h1>
            <p class="text-lg text-slate-600">Manage your restaurant menu items</p>
        </div>
        <a href="{{ route('merchant.menus.create') }}" class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-bold">
            + Add New Menu
        </a>
    </div>

    @if($menus->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($menus as $menu)
                <div class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:border-orange-300 hover:shadow-lg transition-all group">
                    <!-- Menu Image -->
                    <div class="h-40 bg-gradient-to-br from-yellow-100 to-orange-100 flex items-center justify-center text-5xl group-hover:scale-110 transition-transform duration-300">
                        🍜
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $menu->name }}</h3>
                        
                        @if($menu->description)
                            <p class="text-sm text-slate-600 mb-4 line-clamp-2">{{ $menu->description }}</p>
                        @endif

                        <div class="mb-6">
                            <p class="text-2xl font-bold text-orange-500">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex gap-2">
                            <a 
                                href="#edit" 
                                class="flex-1 text-center px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all font-medium text-sm"
                            >
                                Edit
                            </a>
                            <form action="#delete" method="POST" class="flex-1" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="w-full px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all font-medium text-sm"
                                >
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg border border-slate-200 p-12 text-center">
            <div class="text-6xl mb-4">🍽️</div>
            <p class="text-slate-600 text-lg mb-6">No menu items yet</p>
            <a href="{{ route('merchant.menus.create') }}" class="inline-block px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-medium">
                Add Your First Menu
            </a>
        </div>
    @endif
</div>
@endsection