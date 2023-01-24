@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Service - new') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Create a new service.") }}
        </p>
    </header>

    <form method="post" action="{{ route('services.store') }}">
        @csrf
        <div class="mt-2">    
            <x-input-text-form 
                label="Service name"
                name="name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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