<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Templates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-right">
                        <x-simple-link to="{{route('templates.create')}}">Create a Template</x-simple-link>
                    </div>

                    <div>
                        @if($templates->isEmpty())
                            <p class="text-center">
                                There are no templates yet. You can
                                <x-simple-link to="{{route('templates.create')}}">add one</x-simple-link>!
                            </p>
                        @else
                            <table class="table-auto w-full inner-horizontal-border inner-vertical-padding">
                                <thead>
                                    <th>Subject</th>
                                    <th>Edit</th>
                                    <td>Delete</td>
                                </thead>
                                <tbody>
                                    @foreach($templates as $template)
                                        <tr>
                                            <td class="text-center">{{$template->subject}}</td>
                                            <td class="text-center">
                                                <a href="{{route('templates.edit', $template->id)}}">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('templates.delete', $template->id)}}" method="post">
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

                            {{$templates->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
