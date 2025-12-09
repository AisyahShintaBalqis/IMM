@extends('Backend.master')

@section('content')

<div class="container mx-auto px-4">
    <div class="card-body">  
        
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Komisariat</h2>

            <a href="{{ route('commission.create') }}"
                class="items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 p-2">
                <i class="ti ti-plus text-xl"></i>
            </a>
        </div>

        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Nama Komisariat</th>
                    <th class="border px-4 py-2 text-left">Cabang</th>
                    <th class="border px-4 py-2 text-left">Universitas / Fakultas</th>
                    <th class="border px-4 py-2 text-left">Ketua Komisariat</th>
                    <th class="border px-4 py-2 text-left">Kontak</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($commission as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->commission_name }}</td>
                    <td class="border px-4 py-2">{{ $item->branch->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->university }}</td>
                    <td class="border px-4 py-2">{{ $item->chairman }}</td>
                    <td class="border px-4 py-2">{{ $item->contact ?? '-' }}</td>

                    <td class="text-center align-middle" style="height: 50px;">
                        <div class="inline-flex items-center gap-2 h-full">
                            
                            <!-- Edit -->
                            <a href="{{ route('commission.edit', $item->id) }}"
                                class="text-blue-600 hover:text-blue-800"
                                title="Edit">
                                <i class="ti ti-edit"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('commission.destroy', $item->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" 
                                class="inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                        class="btn-delete text-red-600 hover:text-red-800" 
                                        data-name="{{ $item->commission_name }}">
                                    <i class="ti ti-trash" style="color: #dc2626;"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center">
                        Belum ada komisariat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $commission->links() }}
        </div>

    </div>
</div>

@endsection
