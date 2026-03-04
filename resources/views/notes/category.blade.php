@extends('layouts.app')

@section('title', $category . ' Notes')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Notes in Category: "{{ $category }}"</h2>

    <a href="{{ route('notes.index') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
        ← Back to all notes
    </a>
</div>

@if($notes->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($notes as $note)
    @include('notes.partials.note-card', ['note' => $note])
    @endforeach
</div>
@else
<p class="text-gray-500 text-center py-8">No notes in this category.</p>
@endif
@endsection