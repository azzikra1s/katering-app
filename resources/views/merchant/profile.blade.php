<!-- resources/views/merchant/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Profile - FoodHub Merchant')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-slate-900 mb-8">Restaurant Profile</h1>

    <div class="bg-white rounded-lg border border-slate-200 p-8">
        <form action="{{ route('merchant.profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Company Name -->
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Company Name *</label>
                <input 
                    type="text"
                    name="company_name"
                    value="{{ old('company_name', $merchant->company_name ?? '') }}"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('company_name') border-red-500 @enderror"
                    placeholder="Enter your restaurant name"
                >
                @error('company_name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Phone Number</label>
                <input 
                    type="tel"
                    name="phone_number"
                    value="{{ old('phone_number', $merchant->phone_number ?? '') }}"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('phone_number') border-red-500 @enderror"
                    placeholder="Enter your phone number"
                >
                @error('phone_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Address</label>
                <textarea 
                    name="address"
                    rows="4"
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('address') border-red-500 @enderror"
                    placeholder="Enter your restaurant address"
                >{{ old('address', $merchant->address ?? '') }}</textarea>
                @error('address')
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
                    placeholder="Tell customers about your restaurant"
                >{{ old('description', $merchant->description ?? '') }}</textarea>
                <p class="text-sm text-slate-600 mt-1">Max 500 characters</p>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-slate-200">
                <button 
                    type="submit"
                    class="flex-1 px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-bold"
                >
                    Save Changes
                </button>
                <a 
                    href="{{ route('merchant.dashboard') }}"
                    class="flex-1 text-center px-6 py-3 border-2 border-slate-300 text-slate-900 rounded-lg hover:border-slate-400 transition-all font-medium"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection