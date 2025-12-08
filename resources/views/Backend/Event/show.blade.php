@extends('Backend.master')

@section('content')
<div class="card">
    <div class="card-body">

        <h2 class="text-2xl font-semibold mb-4">{{ $event->title }}</h2>

        @if ($event->thumbnail)
            <img src="{{ asset('storage/' . $event->thumbnail) }}" 
                class="w-64 rounded mb-4" 
                alt="Thumbnail">
        @endif

        <p class="text-gray-600 mb-2">
            <strong>Slug:</strong> {{ $event->slug }}
        </p>

        <p class="text-gray-600 mb-2">
            <strong>Status:</strong> 
            @if ($event->status === 'published')
                <span class="text-green-600 font-semibold">Published</span>
            @else
                <span class="text-yellow-600 font-semibold">Draft</span>
            @endif
        </p>

        <div class="prose max-w-full">
            {!! $event->content !!}
        </div>

        <div class="mt-6">
            <a href="{{ route('event.index') }}" 
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
            Kembali
            </a>
        </div>

    </div>
</div>
@endsection
