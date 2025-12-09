@extends('Backend.master')

@section('content')

<div class="container mx-auto px-4">
    <div class="card-body">  
        
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Galeri</h2>

            <a href="{{ route('galeri.create') }}"
                class="items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 p-2">
                <i class="ti ti-plus text-xl"></i>
            </a>
        </div>              
        
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>                    
                    <th class="border px-4 py-2 text-left">Judul</th>
                    <th class="border px-4 py-2 text-left">Gambar</th>
                    <th class="border px-4 py-2 text-left">Tanggal Upload</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($gallery as $item)
                <tr>

                    {{-- Judul --}}
                    <td class="border px-4 py-2">
                        {{ $item->title ?? '-' }}
                    </td>

                    {{-- Gambar --}}
                    <td class="border px-4 py-2">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="w-16 h-16 rounded object-cover">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- Tanggal Upload --}}
                    <td class="border px-4 py-2">
                        {{ $item->created_at->format('d M Y') }}
                    </td>

                    {{-- Aksi --}}
                    <td class="border text-center align-middle" style="height: 50px;">
                        <div class="inline-flex items-center gap-2 h-full">

                            {{-- Edit --}}
                            <a href="{{ route('galeri.edit', $item->id) }}"
                                class="text-blue-600 hover:text-blue-800"
                                title="Edit">
                                <i class="ti ti-edit"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('galeri.destroy', $item->id) }}" 
                            method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" 
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                    class="btn-delete text-red-600 hover:text-red-800" 
                                    data-name="{{ $item->title }}">
                                <i class="ti ti-trash" style="color: #dc2626;"></i>
                            </button>
                        </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">
                        Belum ada data galeri.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $gallery->links() }}
        </div>

    </div>
</div>

@endsection
