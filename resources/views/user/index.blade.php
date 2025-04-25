<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User  ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <!-- Form pencarian -->
                <div class="px-6 pt-6 mb-8 w-full sm:w-2/3 md:w-1/2 lg:w-1/3">
                    <form class="flex items-center gap-3" method="GET" action="{{ route('user.index') }}">
                        <x-text-input 
                            id="search" name="search" type="text" 
                            class="w-full md:w-5/6 px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400" 
                            placeholder="Search by name or email ..." 
                            value="{{ request('search') }}" autofocus 
                            aria-label="Search" 
                        />
                        <x-primary-button type="submit" class="px-4 py-2 rounded-md ml-2">
                            {{ __('Search') }}
                        </x-primary-button>
                    </form>
                </div>

                <!-- Menampilkan hasil pencarian -->
                @if (request('search'))
                    <div class="px-6 text-xl text-gray-900 dark:text-gray-100 mb-4">
                        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            Search results for: <strong>{{ request('search') }}</strong>
                        </h2>
                    </div>
                @endif

                <!-- Tabel hasil pencarian -->
                <div class="relative overflow-x-auto mb-6">
                    @if (request('search') && $users->isEmpty())
                        <div class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No results found for "{{ request('search') }}"
                        </div>
                    @else
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Id</th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="hidden px-6 py-3 md:block">Email</th>
                                    <th scope="col" class="px-6 py-3">Todo</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $data)
                                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                                            {{ $data->id }}
                                        </td>
                                        <td class="px-6 py-4">{{ $data->name }}</td>
                                        <td class="hidden px-6 py-4 md:block">{{ $data->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p>
                                                {{ $data->todos->count() }}
                                                <span>
                                                    <span class="text-green-600 dark:text-green-400">
                                                        ({{ $data->todos->where('is_done', true)->count() }})
                                                    </span>/ 
                                                    <span class="text-blue-600 dark:text-blue-400">
                                                        {{ $data->todos->where('is_done', false)->count() }}
                                                    </span>
                                                </span>
                                            </p>
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="px-6 py-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
