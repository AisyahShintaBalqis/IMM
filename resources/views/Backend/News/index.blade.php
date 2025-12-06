@extends('Backend.master')

@section('content')

<div class="container mx-auto px-4">
    <div class="card-body ">  
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Artikel</h2>
            <a href="{{ route('news.create') }}"
            class="items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700">
            <i class="ti ti-plus text-xl"></i>
            </a>
        </div>              
        
        <table class="table-auto w-full border-collapse border border-gray-200 ">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Title</th>
                    <th class="border px-4 py-2 text-left">Slug</th>
                    <th class="border px-4 py-2 text-left">Konten</th>
                    <th class="border px-4 py-2 text-left">Thumbnail</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->title }}</td>
                    <td class="border px-4 py-2">{{ $item->slug }}</td>
                    <td class="border px-4 py-2">
                        {!! Str::limit(strip_tags($item->content), 60) !!}
                    </td>
                    <td class="border px-4 py-2">
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                class="w-16 h-16 rounded object-cover">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($item->status === 'published')
                            <span class="text-green-600 font-semibold">Publish</span>
                        @else
                            <span class="text-red-600 font-semibold">Draft</span>
                        @endif
                    </td>
                    
                    <td class="aksi text-center align-middle" style="height: 50px;">
                    <div class="inline-flex items-center gap-2 h-full">

                        <a href="{{ route('news.edit', $item->id) }}" 
                        class="text-blue-600 hover:text-blue-800" title="Edit">
                        <i class="ti ti-edit"></i>
                        </a>

                        <form action="" method="POST" onsubmit="return confirm('Yakin ingin menghapus ujian ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete text-red-600 hover:text-red-800" data-name="">
                                <i class="ti ti-trash" style="color: #dc2626;"></i>
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center">Belum ada ujian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
