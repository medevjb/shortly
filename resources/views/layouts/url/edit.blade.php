<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Url') }}
            </h2>
            <div>
                <a href="{{ route('urls.index') }}"
                    class="bg-primary hover:bg-blue-500 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">All</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <form action="{{ route('urls.update',['url' => $url->short]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label for="url"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Long Url</label>
                            <input type="text" name="url" value="{{ old('url', $url->url) }}" id="url"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter Long URL"  />
                            @error('url')
                                <div class="valid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <button type="submit"
                            class="bg-primary hover:bg-blue-500 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Update</button>
                        </div>    
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
