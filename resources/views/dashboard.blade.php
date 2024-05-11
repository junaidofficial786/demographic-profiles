<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()->is_admin)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-3xl font-bold text-center">
                        {{ __('Approve Users') }}
                    </div>

                    @if(session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                      </div>
                      @endif

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table
                            class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Name</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Email</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Gender</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Registered At</th>
                                    <th
                                        class="py-2 px-3 bg-gray-200 font-semibold text-sm uppercase border-b border-gray-300">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-100">
                                        <td class="py-4 px-6 border-b border-gray-300">{{ $user->name }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">{{ $user->email }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">{{ $user->gender }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">{{ $user->created_at->diffForHumans() }}</td>
                                        <td class="py-4 px-6 border-b border-gray-300">
                                            <form method="POST" action="{{ route('profile.approve', ['user' => $user->id]) }}">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="px-6 py-2 bg-green-300 rounded-sm">Approve</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links('pagination.custom-pagination') }}
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __('Normal User') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
