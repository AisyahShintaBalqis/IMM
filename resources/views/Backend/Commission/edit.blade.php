@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Edit Komisariat</h2>

        <form action="{{ route('commission.update', $commission->id) }}" 
            method="POST" 
            class="space-y-6">

            @csrf
            @method('PUT')

            {{-- Cabang --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Cabang</label>
                <select name="branch_id" 
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" 
                            {{ old('branch_id', $commission->branch_id) == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
                @error('branch_id') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Nama Komisariat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Komisariat</label>
                <input type="text" name="commission_name" 
                    value="{{ old('commission_name', $commission->commission_name) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('commision_name') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Universitas / Fakultas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Universitas / Fakultas</label>
                <input type="text" name="university" 
                    value="{{ old('university', $commission->university) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('university') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Ketua Komisariat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Ketua Komisariat</label>
                <input type="text" name="chairman" 
                    value="{{ old('chairman', $commission->chairman) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('chairman') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Kontak (opsional) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kontak (Opsional)</label>
                <input type="text" name="contact" 
                    value="{{ old('contact', $commission->contact) }}"
                    class="w-full rounded-md border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('contact') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-4 mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700">
                    Update
                </button>

                <a href="{{ route('commission.index') }}" 
                    class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
