@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inquiry') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
        <div class="mb-4">
        </div>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Inquiry Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update inquiry information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('inquiries.update', $inquiry->id) }}">
        @method('PATCH') 
        @csrf
            <div class="mt-2">
                <label for="service_id" class="block font-medium text-sm text-gray-700">{{ __('Service') }}</label>
                <select id="service_id" class="
                    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                    aria-label="service_id" name="service_id" id="service_id" required="required" autofocus="autofocus" autocomplete="service_id"
                >
                    <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                    @foreach ($other_services as $other_service)
                        <option value="{{ $other_service->id }}">{{ $other_service->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
            </div>
    
            <div class="mt-2">
                <label for="city_id" class="block font-medium text-sm text-gray-700">{{ __('City') }}</label>
                <select id="city_id" class="
                    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                    aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
                >
                    <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                    @foreach ($other_cities as $other_city)
                        <option value="{{ $other_city->id }}">{{ $other_city->name }}</option>
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
                    @if($inquiry->weight == '5') {
                        <option selected value="5">do 5 kg</option>
                        <option value="20">do 20 kg</option>
                        <option value="40">do 40 kg</option>
                        <option value="40+">40kg+</option>
                    }
    
                    @elseif($inquiry->weight == '20') {
                        <option selected value="20">do 20 kg</option>
                        <option value="5">do 5 kg</option>
                        <option value="40">do 40 kg</option>
                        <option value="40+">40kg+</option>
                    }

                    @elseif($inquiry->weight == '40') {
                        <option selected value="40">do 40 kg</option>
                        <option value="5">do 5 kg</option>
                        <option value="20">do 20 kg</option>
                        <option value="40+">40kg+</option>
                    }

                    @elseif($inquiry->weight == '40+') {
                        <option selected value="40+">40kg+</option>
                        <option value="5">do 5 kg</option>
                        <option value="20">do 20 kg</option>
                        <option value="40">do 40 kg</option>
                    }

                    @endif
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

                    @if($inquiry->weight == '>1') {
                        <option selected value=">1">do roku</option>
                        <option value="1-5">1-5</option>
                        <option value="5-8">5-8</option>
                        <option value="<8">ponad 8</option>
                    }
    
                    @elseif($inquiry->weight == '1-5') {
                        <option selected value="1-5">1-5</option>
                        <option value="5-8">5-8</option>
                        <option value=">1">do roku</option>
                        <option value="<8">ponad 8</option>
                    }

                    @elseif($inquiry->weight == '<8') {
                        <option selected value="<8">ponad 8</option>
                        <option value="5-8">5-8</option>
                        <option value=">1">do roku</option>
                        <option value="1-5">1-5</option>
                    }

                    @elseif($inquiry->weight == '5-8') {
                        <option selected value="5-8">5-8</option>
                        <option value="<8">ponad 8</option>
                        <option value=">1">do roku</option>
                        <option value="1-5">1-5</option>
                    }

                    @endif
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
                >{{ $inquiry->message }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>
    
            <div class="mt-2">
                <label for="petsitter_id" class="block font-medium text-sm text-gray-700">{{ __('Petsitter') }}</label>
                <select id="petsitter_id" class="
                    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                    aria-label="petsitter_id" name="petsitter_id" id="petsitter_id" required="required" autofocus="autofocus" autocomplete="petsitter_id"  
                >
                    <option value="{{ $petsitter->id }}" selected>{{ $petsitter->name }}</option>
                    @foreach ($other_petsitters as $other_petsitter)
                        <option value="{{ $other_petsitter->id }}">{{ $other_petsitter->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('petsitter_id')" class="mt-2" />
    
            </div>
    
            <div class="mt-2">
                
                <label for="customer_id" class="block font-medium text-sm text-gray-700">{{ __('Customer') }}</label>
                <select id="customer_id" class="
                    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                    aria-label="customer_id" name="customer_id" id="customer_id" required="required" autofocus="autofocus" autocomplete="customer_id"  
                >
                    <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                    @foreach ($other_customers as $other_customer)
                        <option value="{{ $other_customer->id }}">{{ $other_customer->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
            </div>

            <div class="mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Save') }}
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