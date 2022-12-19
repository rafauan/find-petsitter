@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inquiries') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-12 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col">

                <div class="flow-root mb-4">
                    <h2 class="font-semibold float-left align-middle">{{ __('List of inquiries') }}</h2>
                    <a href="{{ route('inquiries.create')}}" class="float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
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
                                    {{ __('Service') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('City') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Weight') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Age') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Message') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Petsitter') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Customer') }}
                                </th>
                                <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                                    {{ __('Creation date') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @unless(count($inquiries) == 0)
                        @foreach($inquiries as $inquiry)
                            <tr class="border-b hover:bg-gray-200 cursor-pointer transition ease-in-out duration-150" onclick="window.location='/inquiries/{{ $inquiry->id }}'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $inquiry->id }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @php 
                                        $service = App\Models\Service::find($inquiry->service_id);
                                    @endphp 

                                    {{ $service->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @php 
                                        $city = App\Models\City::find($inquiry->city_id);
                                    @endphp 

                                    {{ $city->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @if($inquiry->weight == '5')
                                        do 5 kg
                                    @elseif($inquiry->weight == '20')
                                        do 20 kg
                                    @elseif($inquiry->weight == '40')
                                        do 40 kg
                                    @elseif($inquiry->weight == '40+')
                                        40kg+
                                    @endif
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @if($inquiry->age == '>1')
                                        do roku
                                    @elseif($inquiry->age == '<8')
                                        ponad 8
                                    @else
                                        {{ $inquiry->age }}
                                    @endif
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $inquiry->message }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @php 
                                        $petsitter = App\Models\User::find($inquiry->petsitter_id);
                                    @endphp 

                                    {{ $petsitter->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @php 
                                        $customer = App\Models\User::find($inquiry->customer_id);
                                    @endphp 

                                    {{ $customer->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $inquiry->created_at }}
                                </td>
                            </tr>
                        @endforeach

                        @else

                        @endunless

                        </tbody>

                        <div>
                            {{ $inquiries->withQueryString()->links() }}
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