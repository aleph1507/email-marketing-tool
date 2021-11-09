<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-right">
                        <x-simple-link to="{{route('customer-groups.create')}}">Create a Group</x-simple-link>
                    </div>

                    <div>
                        @if($customerGroups->isEmpty())
                            <p class="text-center">
                                There are no customer groups yet. You can
                                <x-simple-link to="{{route('customer-groups.create')}}">add one</x-simple-link>!
                            </p>
                        @else
                            <table class="table-auto w-full inner-horizontal-border inner-vertical-padding">
                                <thead>
                                    <th>Name</th>
                                    <th>Customers</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    @foreach($customerGroups as $group)
                                        <tr>
                                            <td class="text-center">{{$group->name}}</td>
                                            <td class="text-center">{{$group->customers->count()}}</td>
                                            <td class="text-center">
                                                <a href="{{route('customer-groups.edit', $group->id)}}">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('customer-groups.delete', $group->id)}}" method="post">
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

                            {{$customerGroups->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
