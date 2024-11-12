<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('tasks.create') }}" >
                        Krijo task te re
                    </a>

                    @if($tasks->isEmpty())
                        <p>Nuk ka taska.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($tasks as $task)
                                <div class="border p-4 rounded-md shadow-md mb-4">
                                    <p><strong>Titulli:</strong> {{ $task->title }}</p>
                                    <p><strong>Pershkrimi:</strong> {{ $task->description }}</p>
                                    <p><strong>Statusi:</strong> 
                                        {{ $task->status ? 'E kompletuar' : 'E Pakompletuar' }}
                                    </p>

                                    <div class="flex space-x-4 mt-2">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">Perditeso</a>

                                         &nbsp;
                                         &nbsp;
                                         &nbsp;
                                         &nbsp;
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('A jeni i sigurt per ta fshire tasken?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Fshije</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
