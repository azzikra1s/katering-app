<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Merchant Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('merchant.profile.update') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Company Name</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $merchant->company_name ?? '') }}" required class="border rounded w-full px-3 py-2">
                        @error('company_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Address</label>
                        <textarea name="address" class="border rounded w-full px-3 py-2" rows="3">{{ old('address', $merchant->address ?? '') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $merchant->phone_number ?? '') }}" class="border rounded w-full px-3 py-2">
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Description</label>
                        <textarea name="description" class="border rounded w-full px-3 py-2" rows="4">{{ old('description', $merchant->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Profile</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>