<x-app-layout>
    <x-slot name="modal">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 grid grid-cols-3 grid-rows-2 grid-flow-row-dense gap-2 justify-start items-start">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg col-span-2">
                <div class="p-6 bg-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body flex flex-col gap-4">
                                        <span class="font-semibold text-lg text-gray-400 leading-tight">New Assignments:</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg row-span-2 ">
                <div class="p-6 bg-white ">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body flex flex-col gap-4">
                                        <span class="font-semibold text-lg text-gray-400 leading-tight">Groups:</span>
                                        @forelse(Auth::user()->teacher->groups as $group)
                                            <div class="bg-purple-300/80 p-2 mt-2 shadow-lg rounded-lg ">
                                                <a href="{{route('group.details',[$group->id])}}">
                                                    <div class="flex justify-between text-xl">
                                                        <span class="text-lg leading-tight">
                                                            {{$group->designation}}
                                                        </span>
                                                            <ion-icon name="arrow-forward-outline"></ion-icon>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <div class="self-center">
                                                No New Lessons Have been posted lately
                                            </div>
                                        @endforelse
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
