@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Tambah Pengurus</h2>

        <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label class="block font-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="w-full rounded-md border border-gray-200 p-2 
                focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name') }}">
                @error('name') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Jabatan -->
            <div class="mb-4">
                <label class="block font-semibold">Amanah</label>
                <input type="text" name="position" class="w-full rounded-md border border-gray-200 p-2 
                focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('position') }}">
                @error('position') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Divisi -->
            <div class="mb-4">
                <label class="block font-semibold">Bidang</label>
                <input type="text" name="division" class="w-full rounded-md border border-gray-200 p-2 
                focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('division') }}">
                @error('division') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Foto -->
            <div class="mb-4">
                <label class="block font-semibold">Foto Pengurus</label>
                <input type="file" name="photo" 
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('photo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div class="mb-4">
                <label class="block font-semibold">Urutan Tampil (Order)</label>
                <input type="number" name="order" class="w-full rounded-md border border-gray-200 p-2 
                focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('order', 0) }}">
                @error('order') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block font-semibold">Status</label>
                <select name="status" class="w-full rounded-md border border-gray-200 p-2 
                focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
                @error('status') 
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
