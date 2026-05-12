<x-layout.app title="Projects">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">My Projects</h1>
        <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-semibold">
            Create Project
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        @if ($projects->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach ($projects as $project)
                    <li class="p-4 hover:bg-gray-50 flex justify-between items-center">
                        <div>
                            <a href="{{ route('projects.show', $project) }}" class="text-lg font-semibold text-blue-600 hover:text-blue-800">
                                {{ $project->title }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($project->description, 100) }}</p>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <span class="px-2 py-1 rounded-full {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="p-4 border-t border-gray-200">
                {{ $projects->links() }}
            </div>
        @else
            <div class="p-8 text-center text-gray-500">
                You don't have any projects yet. Create one to get started!
            </div>
        @endif
    </div>
</x-layout.app>
