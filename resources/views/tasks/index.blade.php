<x-layouts::app :title="__('My Tasks')">

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">My Tasks</h1>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium">Create Task</a>
        </div>
        @if(session('success'))
            <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter and Search Form -->
        <form method="GET" action="{{ route('tasks.index') }}" class="grid grid-cols-1 gap-4 rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm md:grid-cols-4">
            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-wide text-zinc-500">Search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Title or description" class="h-11 w-full rounded-xl border-zinc-200 bg-zinc-50 px-3 text-sm placeholder:text-zinc-400 focus:border-amber-500 focus:ring-amber-500">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-wide text-zinc-500">Status</span>
                <span class="relative block">
                    <select name="status" class="h-11 w-full appearance-none rounded-xl border-zinc-200 bg-zinc-50 px-3 pr-10 text-sm focus:border-amber-500 focus:ring-amber-500">
                        <option value="">All statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In progress</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-zinc-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0l-4.25-4.51a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" /></svg>
                </span>
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-wide text-zinc-500">Priority</span>
                <span class="relative block">
                    <select name="priority" class="h-11 w-full appearance-none rounded-xl border-zinc-200 bg-zinc-50 px-3 pr-10 text-sm focus:border-amber-500 focus:ring-amber-500">
                        <option value="">All priorities</option>
                        <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-zinc-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0l-4.25-4.51a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" /></svg>
                </span>
            </label>

            <div class="flex items-end gap-2">
                <button type="submit" class="h-11 w-full rounded-xl bg-zinc-900 px-4 text-sm font-semibold text-white transition hover:bg-zinc-700">Apply filters</button>
                <a href="{{ route('tasks.index') }}" class="flex h-11 w-full items-center justify-center rounded-xl border border-zinc-200 px-4 text-sm font-semibold text-zinc-600 transition hover:bg-zinc-50">Reset</a>
            </div>
        </form>

        <!-- Task Table -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">Title</th>
                        <th class="px-6 py-3 text-left font-medium">Status</th>
                        <th class="px-6 py-3 text-left font-medium">Priority</th>
                        <th class="px-6 py-3 text-left font-medium">Due Date</th>
                        <th class="px-6 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $task->title }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold {{ $task->priority === 'high' ? 'text-red-600' : ($task->priority === 'medium' ? 'text-orange-500' : 'text-blue-500') }}">
                                {{ ucfirst($task->priority) }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500">No tasks found matching criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>