@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">

        <h2 class="text-2xl font-semibold mb-4">{{ $news->title }}</h2>

        @if ($news->thumbnail)
            <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                class="w-64 rounded mb-4" 
                alt="Thumbnail">
        @endif

        <p class="text-gray-600 mb-2">
            <strong>Slug:</strong> {{ $news->slug }}
        </p>

        <p class="text-gray-600 mb-2">
            <strong>Status:</strong> 
            @if ($news->status === 'published')
                <span class="text-green-600 font-semibold">Published</span>
            @else
                <span class="text-yellow-600 font-semibold">Draft</span>
            @endif
        </p>

        <div class="prose max-w-full">
            {!! $news->content !!}
        </div>

        <div class="mt-6">
            <a href="{{ route('news.index') }}" 
            class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            Kembali
            </a>
        </div>

    </div>
</div>
@endsection
