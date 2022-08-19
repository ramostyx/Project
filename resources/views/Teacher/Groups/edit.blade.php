<x-app-layout>

    <x-slot name="modal">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Group') }}
        </h2>
    </x-slot>
    <div class="py-12 m-auto">
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
                                                        <form method="POST" action="{{ route('groups.update',$group->id) }}">
                                                            @method('PUT')
                                                            @csrf

                                                            <div class="grid grid-cols-2 gap-6">
                                                                <div class="grid grid-rows-2 gap-6 col-span-1">
                                                                    <div>
                                                                        <x-label for="designation" :value="__('Designation')" />
                                                                        <x-input id="designation" class="block mt-1 w-full" type="text" name="designation" value="{{$group->designation}}" autofocus />
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="capacity" :value="__('Capacity')" />
                                                                        <x-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" value="{{$group->capacity}}" autofocus />
                                                                    </div>
                                                                </div>
                                                                <div class="grid grid-rows-2 gap-6 col-span-1">
                                                                    <div>
                                                                        <x-label for="year" :value="__('Year')" />
                                                                        <x-input id="year" class="block mt-1 w-full" type="text" name="year" value="{{$group->year}}" autofocus />
                                                                    </div>
                                                                    <div>
                                                                        <x-label for="level" :value="__('Level')" />
                                                                        <x-input id="level" class="block mt-1 w-full" type="text" name="level" value="{{$group->level}}" autofocus />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex items-center justify-end mt-4">
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
