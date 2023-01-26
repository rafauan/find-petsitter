@if(Auth::user()->role == 'Petsitter' && $opinion->petsitter_id == Auth::user()->id)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Opinion') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Score') }}
                </h5>
                <p>
                    <x-star-rating :numberOfStars="$opinion->score" />
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Message') }}
                </h5>
                <p>
                    {{ $opinion->text }}
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Status') }}
                </h5>
                <p>
                    @if($opinion->status == 'Pending')
                        <span class="bg-neutral-400 text-white py-2 px-2 rounded">
                            {{ __($opinion->status) }}
                        </span>
                    @else
                        <span class="bg-emerald-600 text-white py-2 px-2 rounded">
                            {{ __($opinion->status) }}
                        </span>
                    @endif
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Customer') }}
                </h5>
                <p>
                    {{ $customer->name }}
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