<x-layout.app title="Edit Task">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="text-blue-600 hover:text-blue-800 mr-4">
                &larr; Back to Task
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Task: {{ $task->title }}</h1>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-forms.label for="title" value="Task Title" />
                    <x-forms.input id="title" type="text" name="title" :value="old('title', $task->title)" required />
                    <x-forms.error :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-forms.label for="description" value="Description" />
                    <textarea id="description" name="description" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" rows="4">{{ old('description', $task->description) }}</textarea>
                    <x-forms.error :messages="$errors->get('description')" />
                </div>

                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_completed" value="1" {{ $task->completed_at ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Mark as Completed</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <x-forms.button>
                        Update Task
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
</x-layout.app>
