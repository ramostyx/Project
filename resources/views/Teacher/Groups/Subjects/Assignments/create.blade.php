<x-app-layout>
    <x-slot name="modal">

    </x-slot>
    <x-slot name="header">

    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative px-6 pt-6 pb-3 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-lg text-gray-700/80 absolute left-1 top-1 p-2">
                        Assignment Creation Form
                    </h2>
                    <div class="content mt-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="flex flex-col">
                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                                    <div class="overflow-hidden">
                                                        <x-validation-errors />
                                                        <form action="{{route('groups.subjects.assignments.store',[$group->id,$subject->id])}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="flex flex-col gap-2">
                                                                <div class="flex gap-2 w-full justify-start items-center">
                                                                    <x-label for="title" value="Title:" />
                                                                    <input
                                                                        name="title"
                                                                        type="text"
                                                                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                        id="title"
                                                                    />
                                                                </div>

                                                                <div class="flex gap-2 w-full justify-start items-center">
                                                                    <x-label for="body" value="Body:" />
                                                                    <input
                                                                        name="body"
                                                                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                        id="body"
                                                                    />
                                                                </div>

                                                                <div class="flex gap-2 w-fit justify-start items-center">
                                                                    <x-label for="date" value="DueDate:" />
                                                                    <input
                                                                        name="date"
                                                                        type="datetime-local"
                                                                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                                        id="date"
                                                                    />
                                                                </div>

                                                                <div class="flex gap-2 w-fit justify-start items-center">
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
                                                                    {{ __('Create') }}
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

