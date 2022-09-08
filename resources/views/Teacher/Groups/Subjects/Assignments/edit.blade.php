<x-app-layout>
    <x-slot name="modal">

    </x-slot>
    <x-slot name="header">

    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="flex flex-col">
                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                                    <div class="overflow-hidden">
                                                        <x-validation-errors />
                                                        <form action="{{route('groups.subjects.assignments.update',[$group->id,$subject->id,$assignment->id])}}" method="POST" enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="flex flex-col gap-2">
                                                                <div class="flex gap-2 w-full justify-start items-center">
                                                                    <x-label for="title" value="Title:" />
                                                                    <input
                                                                        name="title"
                                                                        type="text"
                                                                        value="{{$assignment->title}}"
                                                                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                        id="title"
                                                                    />
                                                                </div>

                                                                <div class="flex gap-2 w-full">
                                                                    <x-label for="body" value="Body:" />
                                                                    <input
                                                                        name="body"
                                                                        value="{{$assignment->body}}"
                                                                        size="255"
                                                                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                        id="body"
                                                                    />
                                                                </div>

                                                                <div class="flex gap-2 w-full justify-start items-center">
                                                                    <x-label for="attachment" value="Attachment:" />
                                                                    <input
                                                                        name="attachment[]"
                                                                        type="file"
                                                                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                        id="attachment"
                                                                        multiple
                                                                    />
                                                                </div>
                                                            </div>

                                                            <div class="flex items-center justify-end mt-8 ">
                                                                <x-button class="ml-4" >
                                                                    {{ __('Update') }}
                                                                </x-button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

