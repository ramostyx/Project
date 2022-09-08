<x-app-layout>
    <x-slot name="modal">
        <x-bladewind.modal
            name="join-group" size="large" title="Enter Group Code"
            show_action_buttons="false">
            <form method="POST" action="{{ route('groups.students.join')}}">
                @csrf
                <x-label for="code" :value="__('Code')" />
                <input
                    type="text"
                    name="code"
                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="designation"
                    required
                />
                <div class="flex items-center justify-end mt-8 ">
                    <x-button class="ml-4" >
                        {{ __('Join') }}
                    </x-button>
                </div>
            </form>
        </x-bladewind.modal>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-start mt-6 ">
        <x-button class="mb-2" onclick="showModal('join-group')">
            {{ __('Join a group') }}
        </x-button>
    </div>

    <div class="flex gap-4 mt-4 flex-wrap">
        @foreach($groups as $group)
            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-xs">
                    <img class="rounded-t-lg" src="https://mdbootstrap.com/img/new/standard/nature/185.jpg" alt=""/>
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
                    </div>
                </div>
            </div>
    @endforeach


</x-app-layout>
