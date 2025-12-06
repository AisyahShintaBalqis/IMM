@extends('Backend.master')

@section('content')

<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Edit Data Pengurus</h2>

        <form action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')


            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" 
                    value="{{ old('name', $member->name) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('name') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>


            {{-- Jabatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                <input type="text" name="position" 
                    value="{{ old('position', $member->position) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('position') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>


            {{-- Division / Bidang --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Bidang</label>
                <input type="text" name="division" 
                    value="{{ old('division', $member->division) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('division') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>


            {{-- Order --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Urutan Tampil</label>
                <input type="number" name="order" 
                    value="{{ old('order', $member->order) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('order') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>


            {{-- Foto --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto</label>

                {{-- Preview Foto Lama --}}
                @if ($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" 
                        class="h-24 w-24 object-cover rounded-md mb-3 border">
                @endif

                <input type="file" name="photo"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('photo') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>


            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="active"   {{ old('status', $member->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $member->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>

                @error('status') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>


            {{-- Tombol --}}
            <div class="flex items-center gap-4 mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700">
                    Update
                </button>

                <a href="{{ route('member.index') }}" 
                    class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
