@if(Auth::user()->role == 'Customer' && $inquiry->customer_id == Auth::user()->id)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inquiry') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Service name') }}
                </h5>
                <p>
                    @php 
                        $service = App\Models\Service::find($inquiry->service_id);
                    @endphp 
                    <span class="inline-block bg-emerald-100 text-emerald-700 rounded-full px-3 py-1 text-sm font-semibold mr-2">
                        {{ $service->name }}
                    </span>
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('City name') }}
                </h5>
                <p>
                    @php 
                        $city = App\Models\City::find($inquiry->city_id);
                    @endphp 
                    {{ $city->name }}
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Weight') }}
                </h5>
                <p>
                    <span class="inline-block bg-gray-200 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold mr-2">
                        @if($inquiry->weight == '5')
                            do 5 kg
                        @elseif($inquiry->weight == '20')
                            do 20 kg
                        @elseif($inquiry->weight == '40')
                            do 40 kg
                        @elseif($inquiry->weight == '40+')
                            40kg+
                        @endif
                    </span>
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Age') }}
                </h5>
                <p>
                    <span class="inline-block bg-gray-200 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold mr-2">
                        @if($inquiry->age == '>1')
                            do roku
                        @elseif($inquiry->age == '<8')
                            ponad 8
                        @else
                            {{ $inquiry->age }}
                        @endif
                    </span>
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Message') }}
                </h5>
                <p>
                    {{ $inquiry->message }}
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Customer') }}
                </h5>
                <p>
                    @php 
                        $customer = App\Models\User::find($inquiry->customer_id);
                    @endphp 
                    <a 
                        class="text-emerald-700 hover:text-gray-800 cursor-pointer transition ease-in-out duration-150"
                        href="/show_profile/{{ $customer->id }}">{{ $customer->name }}
                    </a>    
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
@else 
<script type="text/javascript">
    window.location.href = "{{ url('/dashboard') }}";
</script>
@endif