<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">My Tasks</h2>
    </x-slot>

    <div class="max-w-[768px] w-full mx-auto p-6">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <input
                type="text"
                name="title"
                placeholder="Task baru"
                class="border p-2 w-full"
            >
            <button class="mt-2 bg-blue-500 text-white rounded-sm px-4 py-2">
                Tambah
            </button>
        </form>
        
        <ul class="mt-4">
            <div class="mb-4 flex gap-2">
                <a href="{{ route('tasks.index') }}" class="px-3 py-1 rounded {{ request('filter') === null ? 'bg-gray-200' : '' }}">All</a>
                <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="px-3 py-1 {{ request('filter') === 'completed' ? 'bg-gray-200' : '' }} rounded">Completed</a>
                <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="px-3 py-1 {{ request('filter') === 'pending' ? 'bg-gray-200' : '' }} rounded">Pending</a>
            </div>

            @foreach ($tasks as $task)
                {{-- <li class="border-b py-2">
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                            @csrf
                            @method('PATCH')
                            <input
                                type="checkbox"
                                onchange="this.form.submit()"
                                {{ $task->is_completed ? 'checked' : '' }}
                            >
                        </form>

                        <span class="{{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </span>
                    </div>

                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 ml-2">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">
                            Hapus
                        </button>
                    </form>
                </li> --}}

                <li class="border-b py-2 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
            @csrf
            @method('PATCH')
            <input type="checkbox" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
        </form>

        <span class="{{ $task->is_completed ? 'line-through text-gray-400' : 'text-black' }}">
            {{ $task->title }}
        </span>
    </div>

    <div class="flex gap-2">
        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:underline">Edit</a>

        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500 hover:underline">Hapus</button>
        </form>
    </div>
</li>


            @endforeach
        </ul>
    </div>
</x-app-layout>
