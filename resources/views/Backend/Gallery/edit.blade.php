@extends('Backend.master')

@section('content')

<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Edit Gallery</h2>

        <form action="{{ route('galeri.update', $gallery->id) }}" 
            method="POST" 
            enctype="multipart/form-data" 
            class="space-y-6">

            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title"
                    value="{{ old('title', $gallery->title) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar</label>

                {{-- Preview Gambar Lama --}}
                @if ($gallery->image)
                    <img src="{{ asset('storage/' . $gallery->image) }}"
                        class="h-28 w-28 object-cover rounded-md mb-3 border">
                @endif

                <input type="file" name="image"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Tombol --}}
            <div class="flex items-center gap-4 mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700">
                    Update
                </button>

                <a href="{{ route('galeri.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
