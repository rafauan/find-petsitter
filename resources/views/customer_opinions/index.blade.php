@if(Auth::user()->role == 'Customer')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your opinions') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 my-12 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                    @unless(count($opinions) == 0)
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('ID') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Text') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Score') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Petsitter') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($opinions as $opinion)
                            <tr class="border-b hover:bg-gray-200 cursor-pointer transition ease-in-out duration-150" onclick="window.location='/customer_opinions/{{ $opinion->id }}'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $opinion->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ Str::limit($opinion->text, 25, '...') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $opinion->score }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $opinion->petsitter->name }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mt-6" role="alert">
                            <p class="font-bold">{{ __("No opinions have been added yet") }}</p>
                            <p>{{ __("Go to") }} <a href="/search" class="font-bold hover:opacity-75 transition ease-in-out duration-150">{{ __("search engine") }}</a> {{ __("to find the right petsitter")}}.</p>
                        </div>
                    @endunless
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@else 
    <script type="text/javascript">
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif