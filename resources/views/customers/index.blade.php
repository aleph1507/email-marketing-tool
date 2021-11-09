<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-right">
                        <x-simple-link to="{{route('customers.create')}}">Add a Customer</x-simple-link>
                    </div>

                    <div>
                        @if($customers->isEmpty())
                            <p class="text-center">
                                There are no customers yet. You can
                                <x-simple-link to="{{route('customers.create')}}">add one</x-simple-link>!
                            </p>
                        @else
                            <table class="table-auto w-full inner-horizontal-border inner-vertical-padding">
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Groups</th>
                                    <th>Sex</th>
                                    <th>Date of Birth</th>
                                    <th>Edit</th>
                                    <td>Delete</td>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td class="text-center">{{ucfirst($customer->first_name)}} {{ucfirst($customer->last_name)}}</td>
                                            <td class="text-center">{{$customer->email}}</td>
                                            <td class="text-center">{{$customer->customerGroups->count()}}</td>
                                            <td class="text-center">{{$customer->sex ? ucfirst($customer->sex) : 'N/A'}}</td>
                                            <td class="text-center">{{$customer->DOB ?? 'N/A'}}</td>
                                            <td class="text-center">
                                                <a href="{{route('customers.edit', $customer->id)}}">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('customers.delete', $customer->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <i class="far fa-trash-alt fa-2x"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$customers->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
