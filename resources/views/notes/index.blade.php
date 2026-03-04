@extends('layouts.app')

@section('title', 'All Notes')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Categories</h2>
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('notes.index') }}" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-full text-sm">
            All
        </a>
        @foreach($categories as $category)
        <a href="{{ route('notes.category', $category) }}" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-full text-sm">
            {{ $category }}
        </a>
        @endforeach
    </div>
</div>

@if($pinnedNotes->count() > 0)
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4 flex items-center">
        <i class="fas fa-thumbtack text-yellow-500 mr-2"></i>Pinned Notes
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($pinnedNotes as $note)
        @include('notes.partials.note-card', ['note' => $note])
        @endforeach
    </div>
</div>
@endif

<div>
    <h2 class="text-2xl font-bold mb-4">All Notes</h2>
    @if($otherNotes->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($otherNotes as $note)
        @include('notes.partials.note-card', ['note' => $note])
        @endforeach
    </div>
    @else
    <p class="text-gray-500 text-center py-8">No notes yet. Create your first note!</p>
    @endif
</div>
@endsection