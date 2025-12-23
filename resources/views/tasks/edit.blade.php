<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Task</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')
            <input
                type="text"
                name="title"
                value="{{ $task->title }}"
                class="border p-2 w-full"
            >
            <button class="mt-2 bg-green-500 text-white px-4 py-2">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
