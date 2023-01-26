@if(Auth::user()->role == 'Petsitter' && $inquiry->petsitter_id == Auth::user()->id)
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
                    <div class="flex justify-between items-center bg-neutral-100 border-l-4 border-neutral-500 text-neutral-700 p-4 mt-6" role="alert">
                        <div>
                            <p class="font-bold">{{ __('Reply to inquiry') }}</p>
                            <p>{{ __('Respond to the inquiry to provide information to the customer') }}</p>
                        </div>
                        <a href="{{ route('answer_to_inquiry', $inquiry->id) }}" class="bg-emerald-700 font-medium text-sm hover:bg-emerald-600 transition text-white py-2 px-2 rounded">
                            {{ __('Reply') }}
                        </a>
                    </div>
                </div>

            @elseif($inquiry->status == "Approved")
                <div class="mb-4">
                    <div class="flex justify-between items-center bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mt-6" role="alert">
                        <div>
                            <p class="font-bold">{{ __('An inquiry was answered') }}</p>
                            <p>{{ __('We are glad that you are able to realize this inquiry') }}</p>
                        </div>
                    </div>
                </div>

            @elseif($inquiry->status == "Rejected")
                <div class="mb-4">
                    <div class="flex justify-between items-center bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mt-6" role="alert">
                        <div>
                            <p class="font-bold">{{ __('An inquiry was answered') }}</p>
                            <p>{{ __('Unfortunately you rejected this inquiry') }}</p>
                        </div>
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
                    {{ __("Customer's message") }}
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