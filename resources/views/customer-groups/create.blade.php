<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($customerGroup) ? __('Edit Group ') . $customerGroup->name : __('New Group') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">

                        <form action="{{isset($customerGroup) ? route('customer-groups.update', $customerGroup->id) : route('customer-groups.store')}}" method="POST">
                            @csrf
                            @if(isset($customerGroup))
                                @method('PATCH')
                            @endif
                            <div class="form-group mb-5 flex items-center">
                                <label for="name" class="w-full md:w-1/6 text-right pr-4">Group Name:</label>
                                <input type="text" class="form-control w-full md:w-3/6"
                                       name="name" id="name" aria-describedby="Group Name"
                                       placeholder="Group Name"
                                       value="{{isset($customerGroup) ? $customerGroup->name : (old('name')) }}" required>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="customers[]" class="w-full md:w-1/6 text-right pr-4">Customers:</label>
                                <select name="customers[]" id="customers" multiple class="custom-select form-control w-full md:w-3/6">
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}" {{isset($customerGroup) && $customerGroup->customers->contains($customer->id) ? 'selected' : ''}}>{{$customer->first_name}} {{$customer->last_name}}, {{$customer->email}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex align-middle items-center justify-center mt-5">
                                <x-button type="submit">Save Group</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
