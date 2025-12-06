@extends('Backend.master')

@section('content')

<div class="container mx-auto px-4">
    <div class="card-body">  
        
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Pengurus</h2>

            <a href="{{ route('member.create') }}"
                class="items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 p-2">
                <i class="ti ti-plus text-xl"></i>
            </a>
        </div>              
        
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>                    
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">Foto</th>
                    <th class="border px-4 py-2 text-left">Jabatan</th>
                    <th class="border px-4 py-2 text-left">Bidang</th>
                    <th class="border px-4 py-2 text-left">Urutan</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($member as $members)
                <tr>

                    {{-- Nama --}}
                    <td class="border px-4 py-2">{{ $members->name }}</td>

                    {{-- Foto --}}
                    <td class="border px-4 py-2">
                        @if($members->photo)
                            <img src="{{ asset('storage/' . $members->photo) }}" 
                                class="w-16 h-16 rounded object-cover">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                                        
                    {{-- Jabatan --}}
                    <td class="border px-4 py-2">{{ $members->position }}</td>

                    {{-- Bidang --}}
                    <td class="border px-4 py-2">{{ $members->division }}</td>

                    {{-- Urutan --}}
                    <td class="border px-4 py-2">{{ $members->order }}</td>

                    {{-- Status --}}
                    <td class="border px-4 py-2">
                        @if ($members->status === 'active')
                            <span class="text-green-600 font-semibold">Aktif</span>
                        @else
                            <span class="text-red-600 font-semibold">Nonaktif</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="border text-center align-middle" style="height: 50px;">
                        <div class="inline-flex items-center gap-2 h-full">

                            {{-- Edit --}}
                            <a href="{{ route('member.edit', $members->id) }}" 
                                class="text-blue-600 hover:text-blue-800" 
                                title="Edit">
                                <i class="ti ti-edit"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('member.destroy', $members->id) }}" 
                            method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" 
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                    class="btn-delete text-red-600 hover:text-red-800" 
                                    data-name="{{ $members->name }}">
                                <i class="ti ti-trash" style="color: #dc2626;"></i>
                            </button>
                        </form>

                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">
                        Belum ada data pengurus.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $member->links() }}
        </div>

    </div>
</div>

@endsection
