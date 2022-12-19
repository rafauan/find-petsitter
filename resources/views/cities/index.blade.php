@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cities') }}
        </h2>
    </x-slot>

    @if(session()->get('success'))
        <div 
            class="fixed top-0 right-0 m-8 p-4 bg-green-100 text-green-700 rounded-lg shadow-xl" 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 2000)"
            role="alert"
            x-transition.duration.500ms
        >
            {{ __(session()->get('success')) }}  
        </div>
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-12 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col">

                <div class="flow-root mb-4">
                    <h2 class="font-semibold float-left align-middle">{{ __('List of cities') }}</h2>
                    <a href="{{ route('cities.create')}}" class="float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Create') }}
                    </a>
                </div>

                <form class="flex">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input 
                            type="search" 
                            id="default-search" 
                            name="search"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-emerald-700 focus:border-emerald-700 transition" 
                            placeholder="{{ __('Search') }}" 
                            value="{{ request()->get('search') }}"
                            required

                        >
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-emerald-600 hover:bg-emerald-500 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-4 py-2 transition">
                            {{ __('Search') }}
                        </button>
                    </div>

                </form>

                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('ID') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('City name') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Country') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Province') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Postal code') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @unless(count($cities) == 0)
                        @foreach($cities as $city)
                            <tr class="border-b hover:bg-gray-200 cursor-pointer transition ease-in-out duration-150" onclick="window.location='/cities/{{ $city->id }}'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $city->id }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $city->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $city->country }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $city->province }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $city->zip_code }}
                                </td>
                            </tr>
                        @endforeach

                        @else

                        @endunless

                        </tbody>

                        <div>
                            {{ $cities->withQueryString()->links() }}
                        </div>
                    </table>
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