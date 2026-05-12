<x-layout.app title="Create Task">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800 mr-4">
                &larr; Back to Project
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Add Task</h1>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="space-y-6">
                @csrf

                <div>
                    <x-forms.label for="title" value="Task Title" />
                    <x-forms.input id="title" type="text" name="title" :value="old('title')" required autofocus />
                    <x-forms.error :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-forms.label for="description" value="Description (Optional)" />
                    <textarea id="description" name="description" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" rows="4">{{ old('description') }}</textarea>
                    <x-forms.error :messages="$errors->get('description')" />
                </div>

                <div>
                    <x-forms.label for="priority" value="Priority" />
                    <select id="priority" name="priority" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    <x-forms.error :messages="$errors->get('priority')" />
                </div>

                <div class="flex justify-end">
                    <x-forms.button>
                        Create Task
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
</x-layout.app>
