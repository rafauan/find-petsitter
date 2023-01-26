@if(Auth::user()->role == 'Petsitter' && $inquiry->petsitter_id == Auth::user()->id)
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
            {{ __('Answer to inquiry') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Remember to stay in the message contact information, such as phone number, etc") }}
        </p>
    </header>

    {{-- {{ route('cities.update', $city->id) }} --}}
    <form method="post" action="{{ route('send_answer', $inquiry->id) }}">
        @method('PATCH') 
        @csrf
        <div class="mt-4">
            <x-input-option-form
                label="Your answer"
                name="answer"
                :options="$answers"
                :extendedOption="false"
            />
        </div>

        <div class="mt-4">
            <x-input-textarea-form 
                label="Your message"
                name="feedback_message"
                placeholder="Your message"
            />
            <x-input-error :messages="$errors->get('feedback_message')" class="mt-2" />
        </div>

        <div class="mt-4">
            <a href="/petsitter_inquiries/{{ $inquiry->id }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </a>

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