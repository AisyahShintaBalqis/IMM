@extends('Backend.master')

@section('content')

<div class="container mx-auto px-4">
    <div class="card-body">  
        
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Kegiatan</h2>

            <a href="{{ route('event.create') }}"
                class="items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700">
                <i class="ti ti-plus text-xl"></i>
            </a>
        </div>

        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Judul</th>
                    <th class="border px-4 py-2 text-left">Slug</th>
                    <th class="border px-4 py-2 text-left">Tanggal</th>
                    <th class="border px-4 py-2 text-left">Lokasi</th>
                    <th class="border px-4 py-2 text-left">Thumbnail</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($event as $events)
                <tr>
                    <td class="border px-4 py-2">{{ $events->title }}</td>
                    <td class="border px-4 py-2">{{ $events->slug }}</td>
                    <td class="border px-4 py-2">{{ $events->event_date }}</td>
                    <td class="border px-4 py-2">{{ $events->location }}</td>

                    <td class="border px-4 py-2">
                        @if ($events->thumbnail)
                            <img src="{{ asset('storage/' . $events->thumbnail) }}" 
                                class="w-16 h-16 rounded object-cover">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="border px-4 py-2">
                        @if ($events->status === 'published')
                            <span class="text-green-600 font-semibold">Publish</span>
                        @else
                            <span class="text-red-600 font-semibold">Draft</span>
                        @endif
                    </td>

                    <td class="text-center align-middle" style="height: 50px;">
                        <div class="inline-flex items-center gap-2 h-full">
                            
                            <!-- Detail -->
                            <a href="{{ route('event.show', $events->id) }}" 
                                class="text-green-600 hover:text-green-800" 
                                title="Detail">
                                <i class="ti ti-eye"></i>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('event.edit', $events->id) }}"
                                class="text-blue-600 hover:text-blue-800"
                                title="Edit">
                                <i class="ti ti-edit"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('event.destroy', $events->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" 
                                class="inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                        class="btn-delete text-red-600 hover:text-red-800" 
                                        data-name="{{ $events->name }}">
                                    <i class="ti ti-trash" style="color: #dc2626;"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">
                        Belum ada kegiatan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $event->links() }}
        </div>

    </div>
</div>

@endsection
