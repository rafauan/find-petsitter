@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inquiry') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Inquiry - new') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Create a new inquiry.") }}
        </p>
    </header>

    <form method="post" action="{{ route('inquiries.store') }}" name="new_inquiry">
        @csrf

        <div class="mt-2">
            @php
                $services = App\Models\Service::all();
            @endphp
            <label for="service_id" class="block font-medium text-sm text-gray-700">{{ __('Service') }}</label>
            <select id="service_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="service_id" name="service_id" id="service_id" required="required" autofocus="autofocus" autocomplete="service_id"
            >
                @foreach ($services as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
        </div>

        <div class="mt-2">
            @php
                $cities = App\Models\City::all();
            @endphp
            <label for="city_id" class="block font-medium text-sm text-gray-700">{{ __('City') }}</label>
            <select id="city_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
            >
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label for="weight" class="block font-medium text-sm text-gray-700">{{ __('Weight') }}</label>
            <select id="weight" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="weight" name="weight" id="weight" required="required" autofocus="autofocus" autocomplete="weight"    
            >
                <option value="5">do 5 kg</option>
                <option value="20">do 20 kg</option>
                <option value="40">do 40 kg</option>
                <option value="40+">40kg+</option>
            </select>
            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label for="age" class="block font-medium text-sm text-gray-700">{{ __('Age') }}</label>
            <select id="age" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="age" name="age" id="age" required="required" autofocus="autofocus" autocomplete="age"  
            >
                <option value=">1">do roku</option>
                <option value="1-5">1-5</option>
                <option value="5-8">5-8</option>
                <option value="<8">ponad 8</option>
            </select>
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label for="message" class="block font-medium text-sm text-gray-700">{{ __('Message') }}</label>
            <textarea
                class="
                    form-control
                    block
                    w-full
                    px-3
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-emerald-700 focus:outline-none
                "
                name="message"
                id="message"
                rows="3"
                required="required"
                placeholder="{{__('Your message')}}"
            ></textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div class="mt-2">
            @php
                $petsitters = App\Models\User::where('role', 'Petsitter')->where('status', 'Published')->get();
            @endphp
            <label for="petsitter_id" class="block font-medium text-sm text-gray-700">{{ __('Petsitter') }}</label>
            <select id="petsitter_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="petsitter_id" name="petsitter_id" id="petsitter_id" required="required" autofocus="autofocus" autocomplete="petsitter_id"  
            >
                @foreach ($petsitters as $petsitter)
                    <option value="{{ $petsitter->id }}">{{ $petsitter->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('petsitter_id')" class="mt-2" />

        </div>

        <div class="mt-2">
            @php
                $customers = App\Models\User::where('role', 'Customer')->where('status', 'Published')->get();
            @endphp
            <label for="customer_id" class="block font-medium text-sm text-gray-700">{{ __('Customer') }}</label>
            <select id="customer_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="customer_id" name="customer_id" id="customer_id" required="required" autofocus="autofocus" autocomplete="customer_id"  
            >
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <a href="{{ route('inquiries.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </a>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Create') }}
            </button>
        </div>

    </form>

    </div>

    </div>
</x-app-layout>
@else 
<script type="text/javascript">
    window.location.href = "{{ url('/dashboard') }}";
</script>
@endif