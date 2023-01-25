@if(Auth::user()->role == 'Customer' && $inquiry->customer_id == Auth::user()->id)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inquiry') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">

            @if($inquiry->status == 'New')
            <div class="mb-4">
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mt-6" role="alert">
                    <p class="font-bold">{{ __('Your inquiry has a status of new') }}</p>
                    <p>{{ __('Petsitter received a message about your inquiry. When he/she responds we will notify you by email') }}</p>
                </div>
            </div>

            @elseif($inquiry->status == "Approved")
                <div class="mb-4">
                    <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mt-6" role="alert">
                        <p class="font-bold">{{ __('Your request has been approved') }}</p>
                        <p>{{ __('Check the feedback message below for details') }}</p>
                    </div>
                </div>

            @elseif($inquiry->status == "Rejected")
                <div class="mb-4">
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mt-6" role="alert">
                        <p class="font-bold">{{ __('Your request has been rejected') }}</p>
                        <p>{{ __('Unfortunately, but your request was rejected. Check the feedback message') }}</p>
                    </div>
                </div>
            @endif

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
                    {{ __('Your message') }}
                </h5>
                <p>
                    <div class="text-gray-700 p-4 rounded bg-gray-100 border-gray-300 border">
                        <p>{{ $inquiry->message }}</p>  
                    </div>
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

            @if($inquiry->status == "Approved" || $inquiry->status == "Rejected")
            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Feedback message') }}
                </h5>
                <div class="text-gray-700 p-4 rounded bg-gray-100 border-gray-300 border">
                    <p>{{ $inquiry->feedback_message }}</p>  
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
@else 
<script type="text/javascript">
    window.location.href = "{{ url('/dashboard') }}";
</script>
@endif