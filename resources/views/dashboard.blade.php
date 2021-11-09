<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-dashboard-section route1="customers.index" slot1="Check out the customers"
                        route2="customers.create" slot2="Add a new one"></x-dashboard-section>

                    <x-dashboard-section route1="customer-groups.index" slot1="See the customer groups"
                                         route2="customer-groups.create" slot2="Create one"></x-dashboard-section>

                    <x-dashboard-section route1="templates.index" slot1="Inspect the templates"
                                         route2="templates.create" slot2="Scribe a template"></x-dashboard-section>

                    <x-dashboard-section route1="campaigns.index" slot1="Manage your mailing campaigns"
                                         route2="campaigns.create" slot2="Start a new one"></x-dashboard-section>
{{--                    <div class="flex flex-col md:flex-row justify-evenly align-middle items-center pb-5 border-b">--}}
{{--                        <x-simple-link to="{{route('customers.index')}}" class="px-6 py-3">Check out the customers</x-simple-link>--}}
{{--                        or--}}
{{--                        <x-simple-link to="{{route('customers.create')}}" class="px-6 py-3">Add a new one</x-simple-link>--}}
{{--                    </div>--}}

{{--                    <div class="flex flex-col md:flex-row justify-evenly align-middle items-center pb-5 border-b">--}}
{{--                        <x-simple-link to="{{route('customer-groups.index')}}" class="px-6 py-3">See the customer groups</x-simple-link>--}}
{{--                        or--}}
{{--                        <x-simple-link to="{{route('customer-groups.create')}}" class="px-6 py-3">Create a new one</x-simple-link>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
