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
            <x-input-option-form
                label="Service"
                name="service_id"
                :options="$services"
                :extendedOption="true"
            />
        </div>

        <div class="mt-2">
            <x-input-option-form
                label="City"
                name="city_id"
                :options="$cities"
                :extendedOption="true"
            />
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
            <x-input-textarea-form 
                label="Message"
                name="message"
                placeholder="Your message"
            />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div class="mt-2">
            <x-input-option-form
                label="Petsitter"
                name="petsitter_id"
                :options="$petsitters"
                :extendedOption="true"
            />
        </div>

        <div class="mt-2">
            <x-input-option-form
                label="Customer"
                name="customer_id"
                :options="$customers"
                :extendedOption="true"
            />
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