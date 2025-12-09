@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Tambah Cabang</h2>

        <form action="{{route('branch.store')}}" method="POST">
            @csrf

            <!-- Nama Cabang -->
            <div class="mb-4">
                <label class="block font-semibold">Nama Cabang</label>
                <input type="text" name="name" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('name') }}">
                @error('name') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Kabupaten/Kota -->
            <div class="mb-4">
                <label class="block font-semibold">Kabupaten/Kota</label>
                <input type="text" name="regency" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('regency') }}">
                @error('regency') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Ketua Cabang -->
            <div class="mb-4">
                <label class="block font-semibold">Ketua Cabang</label>
                <input type="text" name="chairman" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('chairman') }}">
                @error('chairman') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Tahun Berdiri -->
            <div class="mb-4">
                <label class="block font-semibold">Tahun Berdiri</label>
                <input type="number" name="year" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('year') }}">
                @error('year') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Kontak (Opsional) -->
            <div class="mb-4">
                <label class="block font-semibold">Kontak </label>
                <input type="text" name="contact" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('contact') }}">
                @error('contact') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Tombol -->
            <div class="pt-4 mt-6">
                <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
