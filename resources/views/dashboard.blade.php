<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-12 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col">

            <div
                class="p-12 text-center relative overflow-hidden bg-no-repeat bg-cover rounded-lg"
                style="
                    background-image: url('https://images.unsplash.com/photo-1501854140801-50d01698950b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');
                    height: 200px;"
            >
                <div
                    class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
                    style="background-color: rgba(0, 0, 0, 0.6)"
                >
                    <div class="flex justify-center items-center h-full">
                    <div class="text-white">
                        <h2 class="font-normal text-4xl mb-4">{{ __('Welcome') }}, {{ Auth::user()->name }}</h2>
                        <h4 class="font-normal text-xl mb-6">{{ __('Type of your account') }} - {{ __(Auth::user()->role) }}</h4>
                    </div>
                    </div>
                </div>
            </div>

                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <div class="mb-4">
                            <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                                {{ __('Number of accounts') }}
                            </h5>
                            <p>
                                {{ count($users) }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                                {{ __('Newest account') }}
                            </h5>
                            <p>
                                <a 
                                    class="hover:text-emerald-700 cursor-pointer transition ease-in-out duration-150"
                                    href="/users/{{ $latestUser->id }}">{{ $latestUser->email }}
                                </a>
                            </p>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                                {{ __('Newest inquiry') }}
                            </h5>
                            <p>
                                TODO
                            </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
