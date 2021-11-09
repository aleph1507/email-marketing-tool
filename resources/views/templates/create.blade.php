<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($template) ? __('Edit Template ') : __('New Template') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">

                        <div class="text-center mb-5">
                            <x-simple-control run="{first_name}">Add first name placeholder</x-simple-control>
                            <x-simple-control run="{last_name}">Add last name placeholder</x-simple-control>
                            <x-simple-control run="{first_name} {last_name}">Add full name placeholder</x-simple-control>
                            <x-simple-control run="{title}">Add title placeholder where applicable</x-simple-control>
                        </div>

                        <form action="{{isset($template) ? route('templates.update', $template->id) : route('templates.store')}}" method="POST">
                            @csrf
                            @if(isset($template))
                                @method('PATCH')
                            @endif
                            <div class="form-group mb-5 flex items-center">
                                <label for="subject" class="w-full md:w-1/6 text-right pr-4">Subject:</label>
                                <input type="text" class="form-control w-full md:w-3/6"
                                       name="subject" id="subject" aria-describedby="Subject"
                                       placeholder="Subject"
                                       value="{{isset($template) ? $template->subject : (old('subject')) }}" required>
                            </div>

                            <div class="form-group mb-5 flex items-center">
                                <label for="body" class="w-full md:w-1/6 text-right pr-4">Message Body:</label>
                                <textarea name="body" id="body"
                                          class="form-control w-full md:w-3/6"
                                          aria-describedby="Message Body"
                                          placeholder="Message Body"
                                >{{isset($template) ? $template->body : (old('body')) }}</textarea>
                            </div>

                            <div class="flex align-middle items-center justify-center mt-5">
                                <x-button type="submit">Save Template</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var templatingStringPos = {};

        window.addEventListener('load', function(ev) {
            let subjectInput = document.getElementById('subject');
            let bodyTextarea = document.getElementById('body');
            let templatingCtrls = document.querySelectorAll('button.run');

            templatingStringPos = {
                el: subjectInput,
                pos: subjectInput.value.length
            };

            [subjectInput, bodyTextarea].forEach(input => {
                ['keyup', 'click', 'focusin'].forEach(event => {
                    input.addEventListener(event, e => {
                        templatingStringPos.el = e.target;
                        templatingStringPos.pos = e.target.selectionStart;
                    });
                });
            });

            templatingCtrls.forEach(btn => {
                btn.addEventListener('click', e => {
                    addTemplatingString(btn.dataset.run);
                    templatingStringPos.pos += btn.dataset.run.length;
                });
            });

        });

        function addTemplatingString(string) {
            //IE support
            if (document.selection) {
                templatingStringPos.el.focus();
                document.selection.createRange().text = string;
            } else {
                // non IE
                templatingStringPos.el.value = templatingStringPos.el.value.substring(0, templatingStringPos.pos) +
                    string + templatingStringPos.el.value.substring(templatingStringPos.pos, templatingStringPos.el.value.length);
            }
        }

        // function insertAtCursor(myField, myValue) {
        //
        //     //MOZILLA and others
        //     else if (myField.selectionStart || myField.selectionStart == '0') {
        //         var startPos = myField.selectionStart;
        //         var endPos = myField.selectionEnd;
        //         myField.value = myField.value.substring(0, startPos)
        //             + myValue
        //             + myField.value.substring(endPos, myField.value.length);
        //     } else {
        //         myField.value += myValue;
        //     }
        // }
    </script>

</x-app-layout>
