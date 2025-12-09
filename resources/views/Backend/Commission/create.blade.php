@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Tambah Komisariat</h2>

        <form action="{{route('commission.store')}}" method="POST">
            @csrf

            <!-- Cabang -->
            <div class="mb-4">
                <label class="block font-semibold">Cabang</label>
                <select name="branch_id" 
                    class="w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Cabang --</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
                @error('branch_id') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Nama Komisariat -->
            <div class="mb-4">
                <label class="block font-semibold">Nama Komisariat</label>
                <input type="text" name="commission_name" 
                    class="w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('commission_name') }}">
                @error('commission_name') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Universitas / Fakultas -->
            <div class="mb-4">
                <label class="block font-semibold">Universitas / Fakultas</label>
                <input type="text" name="university" 
                    class="w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('university') }}">
                @error('university') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Ketua Komisariat -->
            <div class="mb-4">
                <label class="block font-semibold">Ketua Komisariat</label>
                <input type="text" name="chairman" 
                    class="w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('chairman') }}">
                @error('chairman') 
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Kontak (Opsional) -->
            <div class="mb-4">
                <label class="block font-semibold">Kontak</label>
                <input type="text" name="contact" 
                    class="w-full rounded-md border border-gray-200 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
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
