@props([
    'task', 'project'
])

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow group">
    <div class="flex items-start justify-between mb-4">
        <div class="flex-1">
            <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $task->title }}</h3>
            
            <div class="flex flex-wrap items-center gap-2">
                <!-- Priority Badge -->
                <span @class([
                    'px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider',
                    'bg-blue-100 text-blue-700' => $task->priority === 'low',
                    'bg-amber-100 text-amber-700' => $task->priority === 'medium',
                    'bg-red-100 text-red-700' => $task->priority === 'high',
                ])>
                    {{ $task->priority }}
                </span>
                
                <!-- Status Badge -->
                @if($task->completed_at)
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-700">
                        Completed
                    </span>
                @else
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-600">
                        Active
                    </span>
                @endif
            </div>
        </div>
        
        <!-- Due Date Chip -->
        @if($task->due_date)
            <div @class([
                'flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium border transition-colors',
                'bg-red-50 text-red-600 border-red-100' => !$task->completed_at && $task->due_date->isPast(),
                'bg-gray-50 text-gray-600 border-gray-200' => $task->completed_at || !$task->due_date->isPast(),
            ])>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ $task->due_date->format('M d, Y') }}</span>
            </div>
        @endif
    </div>

    @if($task->description)
        <p class="text-gray-600 text-sm mb-6 line-clamp-2 leading-relaxed">
            {{ $task->description }}
        </p>
    @endif

    <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-50 opacity-0 group-hover:opacity-100 transition-opacity">
        @if(auth()->id() === $project->user_id)
            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Task">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </a>
            
            <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Task">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        @endif
    </div>
</div>
