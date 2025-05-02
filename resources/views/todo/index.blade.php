<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-100 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <!-- CREATE BUTTON & FLASH MESSAGE -->
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-xl text-gray-700 dark:text-gray-100">
                    <div class="flex items-center justify-between gap-4 flex-wrap">
                        <div>
                            <x-create-button href="{{ route('todo.create') }}" />
                        </div>

                        @if (session('success'))
                        <div class="flex items-center p-3 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-green-900/30 dark:text-green-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('danger'))
                        <div class="flex items-center p-3 text-sm text-red-800 bg-red-50 rounded-lg dark:bg-red-900/30 dark:text-red-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('danger') }}</span>
                        </div>
                    @endif                      
                    </div>
                </div>
            </div>



                <!-- TODO TABLE -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
                        <thead class="text-sm text-gray-600 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $data)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">

                                    <!-- TITLE -->
                                    <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-200">
                                        <a href="{{ route('todo.edit', $data) }}" class="hover:underline text-sm">
                                            {{ $data->title }}
                                        </a>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="px-6 py-4">
                                        @if ($data->is_done)
                                            <span class="bg-green-900 text-green-400 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                Done
                                            </span>
                                        @else
                                            <span class="bg-indigo-900 text-blue-400 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                Ongoing
                                            </span>
                                        @endif
                                    </td>

                                    <!-- ACTION (FIXED SPACING) -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4"> <!-- Menggunakan gap untuk spacing konsisten -->
                                            @if ($data->is_done)
                                                <form action="{{ route('todo.uncomplete', $data) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                                        Uncomplete
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('todo.complete', $data) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="text-green-600 dark:text-green-400 hover:underline text-sm font-medium">
                                                        Complete
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('todo.destroy', $data) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 dark:text-red-400 hover:underline text-sm font-medium"
                                                        onclick="return confirm('Are you sure you want to delete this todo?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- DELETE ALL COMPLETED TASK BUTTON -->
                @if ($todosCompleted > 1)
                <div class="p-6 text-xl text-gray-700 dark:text-gray-100">
                    <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button>
                            Delete All Completed Task
                        </x-primary-button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>