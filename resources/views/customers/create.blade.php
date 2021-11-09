<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($customer) ? __('Edit Customer ') . $customer->first_name . ' ' . $customer->last_name : __('New Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">

                        <form action="{{isset($customer) ? route('customers.update', $customer->id) : route('customers.store')}}" method="POST">
                            @csrf
                            @if(isset($customer))
                                @method('PATCH')
                            @endif
                            <div class="form-group mb-5 flex items-center">
                                <label for="first_name" class="w-full md:w-1/6 text-right pr-4">First Name:</label>
                                <input type="text" class="form-control w-full md:w-3/6"
                                       name="first_name" id="first_name" aria-describedby="First Name"
                                       placeholder="First Name"
                                       value="{{isset($customer) ? $customer->first_name : (old('first_name')) }}" required>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="last_name" class="w-full md:w-1/6 text-right pr-4">Last Name:</label>
                                <input type="text" class="form-control w-full md:w-3/6"
                                       name="last_name" id="last_name" aria-describedby="Last Name"
                                       placeholder="Last Name"
                                       value="{{isset($customer) ? $customer->last_name : (old('last_name')) }}">
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="email" class="w-full md:w-1/6 text-right pr-4">Email:</label>
                                <input type="text" class="form-control w-full md:w-3/6"
                                       name="email" id="email" aria-describedby="Email"
                                       placeholder="Email"
                                       value="{{isset($customer) ? $customer->email : (old('email')) }}">
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="customerGroups[]" class="w-full md:w-1/6 text-right pr-4">Customer Groups:</label>
                                <select name="customerGroups[]" id="customerGroups" multiple class="custom-select form-control w-full md:w-3/6">
                                    @foreach($customerGroups as $group)
                                        <option value="{{$group->id}}" {{isset($customer) && $customer->customerGroups->contains($group->id) ? 'selected' : ''}}>{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="sex" class="w-full md:w-1/6 text-right pr-4">Sex:</label>
                                <select name="sex" id="sex" class="custom-select form-control w-full md:w-3/6">
                                    <option value="male" {{(isset($customer) && $customer->sex==='male') || old('sex')==='male' ? 'selected' : ''}}>Male</option>
                                    <option value="female" {{(isset($customer) && $customer->sex==='female') || old('sex')==='female' ? 'selected' : ''}}>Female</option>
                                    <option value="" {{(isset($customer) && !$customer->sex) ? 'selected' : ''}}>Other/Not specified</option>
                                </select>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="DOB" class="w-full md:w-1/6 text-right pr-4">Date of Birth:</label>
                                <input type="date" class="form-control w-full md:w-3/6" id="DOB"
                                       aria-describedby="Date of Birth" name="DOB"
                                       value="{{isset($customer) ? $customer->DOB : (old('DOB')) }}">
                            </div>

                            <div class="flex align-middle items-center justify-center mt-5">
                                <x-button type="submit">Save Customer</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
