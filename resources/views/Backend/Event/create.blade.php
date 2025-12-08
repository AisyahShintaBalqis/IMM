@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Tambah Kegiatan</h2>

        <form action="{{route('event.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Kegiatan -->
            <div class="mb-4">
                <label class="block font-semibold">Nama Kegiatan</label>
                <input type="text" name="title" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('title') }}">
                @error('title') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            
            <!-- Tanggal Kegiatan -->
            <div class="mb-4">
                <label class="block font-semibold">Tanggal Kegiatan</label>
                <input type="date" name="event_date" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('event_date') }}">
                @error('event_date') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            
            <!-- Lokasi -->
            <div class="mb-4">
                <label class="block font-semibold">Lokasi</label>
                <input type="text" name="location"
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('location') }}">
                @error('location') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Thumbnail -->
            <div class="mb-4">
                <label class="block font-semibold">Thumbnail Kegiatan</label>
                <input type="file" name="thumbnail"
                    class="w-full rounded-md border border-gray-200 p-3 
                    focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('thumbnail')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block font-semibold">Deskripsi</label>
                <textarea id="content" name="content" rows="6" 
                    class="ckeditor w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content') }}</textarea>
                @error('content') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block font-semibold">Status</label>
                <select name="status" 
                    class="w-full rounded-md border border-gray-200 p-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="draft">Draft</option>
                    <option value="published">Publish</option>
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
