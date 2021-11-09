<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($campaign) ? __('Edit Campaign') : __('New Campaign') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">

                        <form action="{{isset($campaign) ? route('campaigns.update', $campaign->id) : route('campaigns.store')}}" method="POST">
                            @csrf
                            @if(isset($campaign))
                                @method('PATCH')
                            @endif
                            <div class="form-group mb-5 flex items-center">
                                <label for="name" class="w-full md:w-1/6 text-right pr-4">Name:</label>
                                <input type="text" class="form-control w-full md:w-3/6"
                                       name="name" id="name" aria-describedby="Campaign Name"
                                       placeholder="Campaign Name"
                                       value="{{isset($campaign) ? $campaign->name : (old('name')) }}" required>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="send_at" class="w-full md:w-1/6 text-right pr-4">Send At:</label>
                                <div id="send_at">
                                    <input type="date" class="form-control w-full md:w-3/6" id="date"
                                           aria-describedby="send_date" name="date"
                                           value="{{isset($campaign) ? $campaignDate : (old('send_at')) }}">
                                    <select name="hour" id="hour" class="inline">
                                        @for($i = 0; $i < 24; $i++)
                                            <option value="{{$i < 10 ? '0' . $i : $i}}"
                                                {{isset($campaign) && $campaignHour === $i ? 'selected' : ''}}>{{$i < 10 ? '0' . $i : $i}}</option>
                                        @endfor
                                    </select> :
                                    <select name="minute" id="minute" class="inline">
                                        @for($i = 0; $i < 60; $i++)
                                            <option value="{{$i < 10 ? '0' . $i : $i}}"
                                                {{isset($campaign) && $campaignMinute === $i ? 'selected' : ''}}>{{$i < 10 ? '0' . $i : $i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="sent" class="w-full md:w-1/6 text-right pr-4">Sent: </label>
                                <input type="checkbox" name="sent" id="sent" value="1" {{isset($campaign) && $campaign->sent ? 'checked' : ''}}>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="template_id" class="w-full md:w-1/6 text-right pr-4">Template:</label>
                                <select name="template_id" id="template_id" class="custom-select form-control w-full md:w-3/6">
                                    @foreach($templates as $template)
                                        <option value="{{$template->id}}" {{isset($campaign) && $campaign->template->id === $template->id ? 'selected' : ''}}>{{$template->subject}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="customer_group_id" class="w-full md:w-1/6 text-right pr-4">Customer Group:</label>
                                <select name="customer_group_id" id="customer_group_id" class="custom-select form-control w-full md:w-3/6">
                                    @foreach($customerGroups as $customerGroup)
                                        <option value="{{$customerGroup->id}}" {{isset($campaign) && $campaign->customerGroup->id === $customerGroup->id ? 'selected' : ''}}>{{$customerGroup->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex align-middle items-center justify-center mt-5">
                                <x-button type="submit">Save Campaign</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
