@props([
    'projects'
])

@if($projects->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
            @foreach($project->tasks as $task)
                <x-task.card :task="$task" :project="$project" />
            @endforeach
        @endforeach
    </div>
@else
    <div class="flex flex-col items-center justify-center py-20 bg-white rounded-2xl border-2 border-dashed     border-gray-200">
        <div class="bg-gray-50 p-4 rounded-full mb-4">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-1">No projects yet</h3>
        <p class="text-gray-500">Get started by creating your first project.</p>

        <a href="{{ route('projects.create') }}" class="mt-6 px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
            Create Project
        </a>
    </div>
@endif