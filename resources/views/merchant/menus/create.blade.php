<!-- resources/views/merchant/menus/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Menu - FoodHub Merchant')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-slate-900 mb-8">Add New Menu Item</h1>

    <div class="bg-white rounded-lg border border-slate-200 p-8">
        <form action="{{ route('merchant.menus.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Menu Name -->
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Menu Name *</label>
                <input 
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror"
                    placeholder="e.g., Nasi Goreng Spesial"
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Description</label>
                <textarea 
                    name="description"
                    rows="4"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('description') border-red-500 @enderror"
                    placeholder="Describe your menu item..."
                >{{ old('description') }}</textarea>
                <p class="text-sm text-slate-600 mt-1">Max 500 characters</p>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Price (Rp) *</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-slate-600">Rp</span>
                    <input 
                        type="number"
                        name="price"
                        value="{{ old('price') }}"
                        required
                        min="0"
                        step="1000"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('price') border-red-500 @enderror"
                        placeholder="0"
                    >
                </div>
                @error('price')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <span class="text-2xl">ℹ️</span>
                    <div class="text-sm text-blue-800">
                        <p class="font-bold mb-1">Menu Item Information</p>
                        <p>Make sure to provide accurate information about your menu items. This will help customers make informed decisions.</p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-slate-200">
                <button 
                    type="submit"
                    class="flex-1 px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-bold"
                >
                    Add Menu Item
                </button>
                <a 
                    href="{{ route('merchant.menus.index') }}"
                    class="flex-1 text-center px-6 py-3 border-2 border-slate-300 text-slate-900 rounded-lg hover:border-slate-400 transition-all font-medium"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection