<x-layout.app title="{{ $project->title }}">
    <div class="mb-6">
        <a href="{{ route('projects.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            &larr; Back to Projects
        </a>
        
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $project->title }}</h1>
                <p class="mt-2 text-gray-600">{{ $project->description }}</p>
                <div class="mt-4">
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>
            </div>
            
            <div class="flex space-x-3">
                <a href="{{ route('projects.edit', $project) }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 text-sm font-medium">
                    Edit Project
                </a>
                
                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm font-medium">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tasks Section -->
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Tasks</h2>
            <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-semibold">
                + Add Task
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            @if ($project->tasks && $project->tasks->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach ($project->tasks as $task)
                        <li class="p-4 hover:bg-gray-50 flex justify-between items-center {{ $task->completed_at ? 'opacity-50' : '' }}">
                            <div class="flex items-center">
                                <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST" class="mr-4">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_completed" value="{{ $task->completed_at ? '0' : '1' }}">
                                    <button type="submit" class="h-5 w-5 rounded border-gray-300 flex items-center justify-center {{ $task->completed_at ? 'bg-blue-600 text-white border-blue-600' : 'bg-white border' }}">
                                        @if($task->completed_at)
                                            ✓
                                        @endif
                                    </button>
                                </form>
                                
                                <div>
                                    <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="text-lg font-medium text-gray-900 {{ $task->completed_at ? 'line-through' : '' }}">
                                        {{ $task->title }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                                <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-8 text-center text-gray-500">
                    No tasks yet. Add one to get started!
                </div>
            @endif
        </div>
    </div>
</x-layout.app>
