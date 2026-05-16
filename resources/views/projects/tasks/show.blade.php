<x-layout.app title="{{ $task->title }}">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">
            &larr; Back to Project
        </a>


        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 {{ $task->completed_at ? 'line-through text-gray-500' : '' }}">
                        {{ $task->title }}
                    </h1>
                    <div class="mt-2 text-sm text-gray-500">
                        Belongs to project: <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:underline">{{ $project->title }}</a>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 text-sm font-medium">
                        Edit
                    </a>
                    
                    <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm font-medium">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="prose max-w-none text-gray-700 mb-8">
                @if($task->description)
                    {{ str_replace("\n", "<br>", $task->description) }}
                @else
                    <em class="text-gray-400">No description provided.</em>
                @endif
            </div>
            
            <div class="border-t border-gray-200 pt-6 flex justify-between items-center">
                <div>
                    Status: 
                    @if($task->completed_at)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Completed
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @endif
                </div>
                
                <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_completed" value="{{ $task->completed_at ? '0' : '1' }}">
                    <button type="submit" class="px-4 py-2 {{ $task->completed_at ? 'bg-gray-200 text-gray-800 hover:bg-gray-300' : 'bg-green-600 text-white hover:bg-green-700' }} rounded-md text-sm font-medium">
                        Mark as {{ $task->completed_at ? 'Pending' : 'Completed' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout.app>
