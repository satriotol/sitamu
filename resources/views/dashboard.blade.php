<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container py-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti maiores temporibus eum
                            deleniti, aliquam illum totam quod quas fugiat dolor officia ad enim distinctio earum harum?
                            Id reprehenderit iste voluptatem?
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti maiores temporibus eum
                            deleniti, aliquam illum totam quod quas fugiat dolor officia ad enim distinctio earum harum?
                            Id reprehenderit iste voluptatem?
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti maiores temporibus eum
                            deleniti, aliquam illum totam quod quas fugiat dolor officia ad enim distinctio earum harum?
                            Id reprehenderit iste voluptatem?
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>
