@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Tambah Galeri</h2>

        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul -->
            <div class="mb-4">
                <label class="block font-semibold">Nama Foto</label>
                <input type="text" name="title"
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Gambar -->
            <div class="mb-4">
                <label class="block font-semibold">Upload Gambar/Video</label>
                <input type="file" name="image"
                    class="w-full rounded-md border border-gray-200 p-3
                    focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('image')
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
