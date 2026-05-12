<x-layout.app title="Edit Project">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800 mr-4">
                &larr; Back
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Project: {{ $project->title }}</h1>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-forms.label for="title" value="Project Title" />
                    <x-forms.input id="title" type="text" name="title" :value="old('title', $project->title)" required />
                    <x-forms.error :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-forms.label for="description" value="Description" />
                    <textarea id="description" name="description" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" rows="4">{{ old('description', $project->description) }}</textarea>
                    <x-forms.error :messages="$errors->get('description')" />
                </div>

                <div>
                    <x-forms.label for="status" value="Status" />
                    <select id="status" name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        <option value="active" {{ old('status', $project->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="archived" {{ old('status', $project->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    <x-forms.error :messages="$errors->get('status')" />
                </div>

                <div class="flex justify-end">
                    <x-forms.button>
                        Update Project
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
</x-layout.app>
