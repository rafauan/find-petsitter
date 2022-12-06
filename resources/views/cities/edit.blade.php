@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('City') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
        <div class="mb-4">
        </div>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('City Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update city information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('cities.update', $city->id) }}">
        @method('PATCH') 
        @csrf
        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="name">{{ __('City name') }}</label>            
            <input class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" value="{{ $city->name }}" required="required" autofocus="autofocus" autocomplete="name">
        </div>

        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="country">{{ __('Country') }}</label>            
            <input class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" id="country" name="country" type="text" value="{{ $city->country }}" required="required" autofocus="autofocus" autocomplete="country">
        </div>

        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="province">{{ __('Province') }}</label>            
            <input class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" id="province" name="province" type="text" value="{{ old('province', $city->province) }}" required="required" autofocus="autofocus" autocomplete="province">
            @foreach($errors->all() as $error)
                <p class="text-red-600 text-sm">{{ __($error) }}</p>
            @endforeach
        </div>

        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="zip_code">{{ __('Postal code') }}</label>            
            <input class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" id="zip_code" name="zip_code" type="text" value="{{ $city->zip_code }}" required="required" autofocus="autofocus" autocomplete="zip_code">
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