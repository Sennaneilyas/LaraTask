<x-layout.app title="Tasks - {{ $project->title }}">
    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800 mb-2 inline-block">
                &larr; Back to Project
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Tasks for {{ $project->title }}</h1>
        </div>
        <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-semibold">
            Create Task
        </a>
    </div>


    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        @if ($tasks->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach ($tasks as $task)
                    <li class="p-4 hover:bg-gray-50 flex justify-between items-center {{ $task->completed_at ? 'opacity-50' : '' }}">
                        <div>
                            <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="text-lg font-medium text-gray-900 {{ $task->completed_at ? 'line-through' : '' }}">
                                {{ $task->title }}
                            </a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="p-8 text-center text-gray-500">
                No tasks in this project yet.
            </div>
        @endif
    </div>
</x-layout.app>
