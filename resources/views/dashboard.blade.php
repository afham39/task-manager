<x-layouts::app :title="__('Dashboard')">
    <div class="flex w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">Task Dashboard</flux:heading>
                <flux:text class="mt-1">Welcome back, {{ auth()->user()->name }}.</flux:text>
            </div>
            <flux:button variant="primary" :href="route('tasks.create')" wire:navigate>
                Create task
            </flux:button>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <flux:card>
                <flux:text>Total tasks</flux:text>
                <flux:heading size="xl" class="mt-2">{{ $totalTasks }}</flux:heading>
            </flux:card>
            <flux:card>
                <flux:text>Pending</flux:text>
                <flux:heading size="xl" class="mt-2">{{ $pendingTasks }}</flux:heading>
            </flux:card>
            <flux:card>
                <flux:text>Completed</flux:text>
                <flux:heading size="xl" class="mt-2">{{ $completedTasks }}</flux:heading>
            </flux:card>
        </div>

        <flux:card>
            <div class="flex items-center justify-between">
                <flux:heading size="lg">Recent tasks</flux:heading>
                <flux:button variant="ghost" :href="route('tasks.index')" wire:navigate>View all</flux:button>
            </div>

            <div class="mt-4 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($recentTasks as $task)
                    <div class="flex items-center justify-between gap-4 py-3">
                        <div class="min-w-0">
                            <flux:text class="truncate font-medium">{{ $task->title }}</flux:text>
                            <flux:text size="sm">{{ ucfirst(str_replace('_', ' ', $task->status)) }} · {{ ucfirst($task->priority) }} priority</flux:text>
                        </div>
                        <flux:button variant="ghost" :href="route('tasks.edit', $task)" wire:navigate>Edit</flux:button>
                    </div>
                @empty
                    <flux:text class="py-6 text-center">You have no tasks yet.</flux:text>
                @endforelse
            </div>
        </flux:card>
    </div>
</x-layouts::app>
