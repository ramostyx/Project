<x-app-layout>
    <x-slot name="modal">
        <x-bladewind.modal
            name="tnc-agreement" size="large" title="Group Creation Form"
            show_action_buttons="false">
            <div class="overflow-hidden mt-2">
                <form method="POST" action="{{ route('groups.store')}}">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <div class="grid grid-rows-2 gap-6 col-span-1">
                            <div>
                                <x-label for="designation" :value="__('Designation')" />
                                <input
                                    type="text"
                                    name="designation"
                                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="designation"
                                    required
                                />
                            </div>
                            <div>
                                <x-label for="capacity" :value="__('Capacity')" />
                                <input
                                    name="capacity"
                                    type="number"
                                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="capacity"
                                />
                            </div>
                        </div>
                        <div class="grid grid-rows-2 gap-6 col-span-1">
                            <div>
                                <x-label for="year" :value="__('Year')" />
                                <input
                                    name="year"
                                    type="text"
                                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="year"
                                />
                            </div>
                            <div>
                                <x-label for="level" :value="__('Level')" />
                                <input
                                    name="level"
                                    type="text"
                                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="level"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-8 ">
                        <x-button class="ml-4" >
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-bladewind.modal>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>



    <div class="flex items-center justify-start mt-6 ">
        <x-button class="mb-2" onclick="showModal('tnc-agreement')">
            {{ __('Create a new group') }}
        </x-button>
    </div>
    <div class="flex gap-4 mt-4 flex-wrap">
        @foreach($groups as $group)
            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-xs">
                    <img class="rounded-t-lg " src="https://mdbootstrap.com/img/new/standard/nature/185.jpg" alt=""/>
                    <div class="p-4">
                        <h5 class="text-gray-900 text-lg font-medium mb-2">{{$group->designation}}</h5>
                        <div class="mb-3 grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-4 col-span-1">
                                <x-label value="Year: {{$group->year}}" />
                                <x-label value="Capacity: {{$group->capacity}}" />
                            </div>
                            <div class="grid grid-rows-2 gap-4 col-span-1">
                                <x-label value="Level: {{$group->level}}" />
                                <x-label value="Code: {{$group->code}}" />
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-gray-100 focus:text-blue-700 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 active:text-blue-800 transition duration-300 ease-in-out">
                                <a href="{{route('group.details',$group->id)}}">Details</a>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="flex justify-center">
            <div class="rounded-lg shadow-lg bg-white max-w-xs">
                <img class="rounded-t-lg " src="https://mdbootstrap.com/img/new/standard/nature/186.jpg" alt=""/>
                <div class="p-4">
                    <h5 class="text-gray-900 text-lg font-medium mb-2">Group B</h5>
                    <div class="mb-3 grid grid-cols-2 gap-6">
                        <div class="grid grid-rows-2 gap-4 col-span-1">
                            <x-label :value="__('Year: 2019/2020')" />
                            <x-label :value="__('Capacity: 47')" />
                        </div>
                        <div class="grid grid-rows-1 gap-4 col-span-1">
                            <x-label :value="__('Level: First Year Highschool')" />
                        </div>
                    </div>
                    <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">edit</button>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="rounded-lg shadow-lg bg-white max-w-xs">
                <img class="rounded-t-lg " src="https://mdbootstrap.com/img/new/standard/nature/187.jpg" alt=""/>
                <div class="p-4">
                    <h5 class="text-gray-900 text-lg font-medium mb-2">Group C</h5>
                    <div class="mb-3 grid grid-cols-2 gap-6">
                        <div class="grid grid-rows-2 gap-4 col-span-1">
                            <x-label :value="__('Year: 2019/2020')" />
                            <x-label :value="__('Capacity: 47')" />
                        </div>
                        <div class="grid grid-rows-1 gap-4 col-span-1">
                            <x-label :value="__('Level: First Year Highschool')" />
                        </div>
                    </div>
                    <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">edit</button>
                </div>
            </div>
        </div>

    </div>




</x-app-layout>
