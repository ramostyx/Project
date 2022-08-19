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


</x-app-layout>
