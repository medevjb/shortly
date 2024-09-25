<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Urls') }}
            </h2>
            <div>
                <a href="{{ route('urls.create') }}" class="bg-primary rounded">Create</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="py-2">
                    <div class="overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-white border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Long Url
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Short Url
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Clicks
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sn = 1;
                                @endphp
                                @forelse ($urls as $url)
                                    <tr class="bg-gray-100 border-b">
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $sn }}
                                        </td>
                                        <td class="text-sm text-center text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <a href="{{ $url->url }}" target="_blank"><i class="fa-solid fa-link"></i></a>
                                        </td>
                                        <td class="text-sm text-center text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ route('url.redirect',['code' => $url->short]) }}
                                        </td>
                                        <td class="text-sm text-center text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{  $url->clicks }}
                                        </td>
                                        <td class="flex justify-center items-center gap-3 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <a href="{{ route('urls.edit', $url->short) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-pen-to-square"></i></a>
                                            </div>
                                            <div>
                                                <form action="{{ route('urls.destroy',  $url->short) }}" method="POST">
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                        @csrf
                                                        @method('DELETE')
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>

                                    @php
                                        $sn++;
                                    @endphp
                                @empty
                                    <h5 class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">No Data
                                    </h5>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
