@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Halaman Baru</h2>

        <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            
            <!-- Judul -->
            <div class="mb-4">
                <label class="block font-semibold">Judul</label>
                <input type="text" name="title" id="title" class="w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Konten -->
            <div class="mb-4">
                <label class="block font-semibold">Isi Konten</label>
                <textarea id="content" name="content" rows="6" class="ckeditor w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content') }}</textarea>
            @error('content') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Thumbnail -->
            <div class="mb-4">
                <label class="block font-semibold">Thumbnail</label>
                <input type="file" name="thumbnail" class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" >
            @error('thumbnail') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block font-semibold">Status</label>
                <select name="status" class="w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                    <option value="draft">Draft</option>
                    <option value="published">Publish</option>
                    @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </select>
            </div>

            <div class="pt-4 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


@endsection
