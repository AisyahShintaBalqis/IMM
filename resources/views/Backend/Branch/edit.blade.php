@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Edit Cabang</h2>

        <form action="{{ route('branch.update', $branch->id) }}" 
            method="POST" 
            class="space-y-6">

            @csrf
            @method('PUT')

            <!-- Nama Cabang -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Cabang</label>
                <input type="text" name="name"
                    value="{{ old('name', $branch->name) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Kabupaten/Kota -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                <input type="text" name="regency"
                    value="{{ old('regency', $branch->regency) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('regency') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Ketua Cabang -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Ketua Cabang</label>
                <input type="text" name="chairman"
                    value="{{ old('chairman', $branch->chairman) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('chairman') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Tahun Berdiri -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun Berdiri</label>
                <input type="number" name="year"
                    value="{{ old('year', $branch->year) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('year') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Kontak -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kontak (Opsional)</label>
                <input type="text" name="contact"
                    value="{{ old('contact', $branch->contact) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('contact') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex items-center gap-4 mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700">
                    Update
                </button>

                <a href="{{ route('branch.index') }}" 
                    class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
