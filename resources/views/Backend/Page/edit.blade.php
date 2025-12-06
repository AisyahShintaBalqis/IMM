@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Edit Halaman</h2>

        <form action="{{ route('page.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title"
                    value="{{ old('title', $page->title) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Konten --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Isi Konten</label>
                <textarea id="content" name="content" rows="6"
                    class="ckeditor w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>{{ old('content', $page->content) }}</textarea>
                @error('content') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Thumbnail --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Thumbnail</label>

                {{-- Preview Thumbnail Lama --}}
                @if ($page->thumbnail)
                    <img src="{{ asset('storage/' . $page->thumbnail) }}"
                        class="h-24 w-24 object-cover rounded-md mb-3 border">
                @endif

                <input type="file" name="thumbnail"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('thumbnail') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="draft" {{ old('status', $page->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $page->status) == 'published' ? 'selected' : '' }}>Publish</option>
                </select>
                @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-4 mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('page.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Batal</a>
            </div>
        </form>
    </div>
</div>


@endsection
