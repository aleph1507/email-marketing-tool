<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Campaigns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-right">
                        <x-simple-link to="{{route('campaigns.create')}}">Create a Campaign</x-simple-link>
                    </div>

                    <div>
                        @if($campaigns->isEmpty())
                            <p class="text-center">
                                There are no campaigns yet. You can
                                <x-simple-link to="{{route('campaigns.create')}}">add one</x-simple-link>!
                            </p>
                        @else
                            <table class="table-auto w-full inner-horizontal-border inner-vertical-padding">
                                <thead>
                                    <th>Name</th>
                                    <th>Send Status</th>
                                    <th>Template</th>
                                    <th>Group</th>
                                    <th>Mail</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    @foreach($campaigns as $campaign)
                                        <tr>
                                            <td class="text-center">{{$campaign->name}}</td>
                                            <td class="text-center">{{$campaign->sent ? 'Already sent' : 'Sending on ' . $campaign->send_at}}</td>
                                            <td class="text-center">
                                                <a href="{{route('templates.edit', $campaign->template->id)}}">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('customer-groups.edit', $campaign->customerGroup->id)}}">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('campaigns.mail', $campaign->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit">
                                                        <i class="far fa-envelope fa-2x"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('campaigns.edit', $campaign->id)}}">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('campaigns.delete', $campaign->id)}}" method="post">
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

                            {{$campaigns->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
