<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-6">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-xl font-semibold text-gray-800">{{ $note->title }}</h3>
            <div class="flex space-x-2">
                <form action="{{ route('notes.toggle-pin', $note) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-gray-500 hover:text-yellow-500">
                        <i class="fas fa-thumbtack {{ $note->is_pinned ? 'text-yellow-500' : '' }}"></i>
                    </button>
                </form>
                <a href="{{ route('notes.edit', $note) }}" class="text-gray-500 hover:text-blue-500">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-500 hover:text-red-500">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        @if($note->category)
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-2">
            {{ $note->category }}
        </span>
        @endif

        <p class="text-gray-600 mb-4">{{ Str::limit($note->content, 150) }}</p>

        <div class="flex justify-between items-center text-sm text-gray-500">
            <span>{{ $note->created_at->diffForHumans() }}</span>
            <a href="{{ route('notes.show', $note) }}" class="text-blue-500 hover:text-blue-700">Read more →</a>
        </div>
    </div>
</div>