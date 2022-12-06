@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
        <div class="mb-4">
        </div>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Service Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update service information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('services.update', $service->id) }}">
        @method('PATCH') 
        @csrf
        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="name">{{ __('Service name') }}</label>            
            <input class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" value="{{ $service->name }}" required="required" autofocus="autofocus" autocomplete="name">
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