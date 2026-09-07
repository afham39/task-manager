<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium">Create Task</a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        @if(session('success'))
            <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter and Search Form -->
        <form method="GET" action="{{ route('tasks.index') }}" class="bg-white p-4 rounded-lg shadow-sm grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or description..." class="rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
            
            <select name="status" class="rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <select name="priority" class="rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">All Priorities</option>
                <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
            </select>

            <div class="flex gap-2">
                <button type="submit" class="w-full px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm">Apply</button>
                <a href="{{ route('tasks.index') }}" class="w-full text-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">Reset</a>
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
</x-app-layout>