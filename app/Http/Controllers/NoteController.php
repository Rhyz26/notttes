<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $pinnedNotes = Note::where('is_pinned', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $otherNotes = Note::where('is_pinned', false)
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Note::distinct('category')
            ->whereNotNull('category')
            ->pluck('category');

        return view('notes.index', compact('pinnedNotes', 'otherNotes', 'categories'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'nullable|max:100',
        ]);

        $note = Note::create($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note created successfully.');
    }

    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'nullable|max:100',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Note deleted successfully.');
    }

    public function togglePin(Note $note)
    {
        $note->update(['is_pinned' => !$note->is_pinned]);

        return redirect()->route('notes.index')
            ->with('success', $note->is_pinned ? 'Note pinned successfully.' : 'Note unpinned successfully.');
    }

    public function filterByCategory($category)
    {
        $notes = Note::where('category', $category)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notes.category', compact('notes', 'category'));
    }
}
