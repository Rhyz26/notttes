@extends('layouts.app')

@section('title', $note->title)

@section('content')
<div class="bg-white rounded-lg shadow-md p-8">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $note->title }}</h1>
            @if($note->category)
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                {{ $note->category }}
            </span>
            @endif
        </div>
        <div class="flex space-x-2">
            <form action="{{ route('notes.toggle-pin', $note) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                    <i class="fas fa-thumbtack {{ $note->is_pinned ? 'text-yellow-500' : '' }} mr-2"></i>
                    {{ $note->is_pinned ? 'Unpin' : 'Pin' }}
                </button>
            </form>
            <a href="{{ route('notes.edit', $note) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>
        </div>
    </div>

    <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">
        {{ $note->content }}
    </div>

    <div class="mt-8 pt-4 border-t text-sm text-gray-500">
        <p>Created: {{ $note->created_at->format('F j, Y, g:i a') }}</p>
        @if($note->created_at != $note->updated_at)
        <p>Updated: {{ $note->updated_at->format('F j, Y, g:i a') }}</p>
        @endif
    </div>
</div>
@endsection