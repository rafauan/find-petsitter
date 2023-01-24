@if(Auth::user()->role == 'Customer')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your inquiries') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-12 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                    @unless(count($inquiries) == 0)
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
                                    {{ __('Creation date') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($inquiries as $inquiry)
                            <tr class="border-b hover:bg-gray-200 cursor-pointer transition ease-in-out duration-150" onclick="window.location='/customer_inquiries/{{ $inquiry->id }}'">
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
                                    {{ Str::limit($inquiry->message, 25, '...') }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @php 
                                        $petsitter = App\Models\User::find($inquiry->petsitter_id);
                                    @endphp 

                                    {{ $petsitter->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $inquiry->created_at }}
                                </td>
                            </tr>
                        @endforeach

                        @else
                            <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mt-6" role="alert">
                                <p class="font-bold">{{ __("It looks like you don't have any queries yet") }}</p>
                                <p>{{ __("Go to") }} <a href="/search" class="font-bold hover:opacity-75 transition ease-in-out duration-150">{{ __("search engine") }}</a> {{ __("to find the right petsitter")}}.</p>
                            </div>
                        @endunless

                        </tbody>
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