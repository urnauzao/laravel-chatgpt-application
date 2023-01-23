<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('OpenAI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form class="mt-6 space-y-6" action="{{ route('openai.index') }}" method="get">
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="search">
                                Text to search in OpenAI:
                            </label>
                            <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="search" name="search" type="text" value="{{ request()->get('search') }}" required="required" autofocus="autofocus" autocomplete="search">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="model">
                                IA Model:
                            </label>
                            @php $selected = request()->get('model', 'text-davinci-003'); @endphp
                            <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="model" name="model" type="text" value="{{ $selected }}" required="required">
                                {!!  join("",$models->map( fn($x) => "<option value='".$x['id']."' ".($selected===$x['id']?'selected':'').">".$x['value']."</option>")->toArray()) !!} 
                            </select>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @isset($result)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        ChatGPT Result
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ $result }}
                    </p>
                    <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                        <em>{!! join(' ', $info) !!}</em>
                    </p>
                </div>
            </div>
            @endisset
        </div>
    </div>
</x-app-layout>
