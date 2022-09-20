<x-app-layout>
    <x-slot name="modal">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


        <div class="py-12 ">
            <div class="max-w-full sm:px-6 lg:px-8 grid grid-cols-3 grid-rows-1 grid-flow-row-dense gap-x-12 items-start">

                <div class="col-span-2">

                    <div class="mt-2">
                        <div class="flex justify-between">
                            <span class="font-semibold text-lg leading-tight">New Lessons:</span>
                        </div>

                        <div class="mt-2 flex flex-col gap-2">
                            @forelse(Auth::user()->student->latestLessons()->take(-3) as $lesson)
                                <a href="{{route('groups.subjects.lessons.show',[$lesson->subject->group->id,$lesson->subject->id,$lesson->id])}}">
                                    <div class="bg-white hover:shadow-xl hover:shadow-gray-400/80 hover:translate-y-2 ease-in-out overflow-hidden shadow-sm rounded-md ">
                                        <div class="p-3 bg-white">
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-body flex justify-between items-center">
                                                                <div class=" flex flex-col gap-1">
                                                                    <span>
                                                                        {{$lesson->subject->group->designation}}
                                                                    </span>
                                                                    <span class="text-sm font-light">
                                                                        {{$lesson->subject->designation}}
                                                                    </span>
                                                                </div>
                                                                <span class="text-sm font-light">
                                                                    {{$lesson->title}}
                                                                </span>
                                                                <div class="mr-12 flex gap-2 font-light text-sm">
                                                                    {{$lesson->created_at->translatedFormat('H:i') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="mx-auto">
                                    <x-bladewind.empty-state
                                        size="60"
                                        message="No new lessons have been posted."
                                        image="{{asset('bladewind/images/No data-amico.svg')}}">
                                    </x-bladewind.empty-state>
                                </div>
                            @endforelse
                        </div>

                    </div>



                    <div class="mt-2 flex flex-col gap-2">
                        <div class="flex justify-between">
                            <span class="font-semibold text-lg leading-tight">New Assignments:</span>
                        </div>
                        @forelse(Auth::user()->student->latestAssignments()->take(-2) as $assignment)
                            <a href="{{route('groups.subjects.assignments.show',[$assignment->subject->group->id,$assignment->subject->id,$assignment->id])}}">
                                <div class="bg-white hover:shadow-xl hover:shadow-gray-400/80 hover:translate-y-2 ease-in-out overflow-hidden shadow-sm rounded-md ">
                                    <div class="p-3 bg-white">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body flex justify-between items-center">
                                                            <div class=" flex flex-col gap-1">
                                                                <span>
                                                                    {{$assignment->subject->group->designation}}
                                                                </span>
                                                                <span class="text-sm font-light">
                                                                    {{$assignment->subject->designation}}
                                                                </span>
                                                            </div>
                                                            <span class="text-sm font-light">
                                                                {{$assignment->title }}
                                                            </span>
                                                            <span class="text-sm font-light">
                                                                {{$assignment->created_at->translatedFormat('H:i') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="mx-auto">
                                <x-bladewind.empty-state
                                    size="45"
                                    message="It's your lucky day no assignments have been issued."
                                    image="{{asset('bladewind/images/Empty-amico.svg')}}">
                                </x-bladewind.empty-state>
                            </div>
                        @endforelse
                    </div>


                </div>
                <div class="bg-transparent overflow-hidden shadow-lg rounded-lg row-span-1">
                    <div class="p-6 bg-transparent ">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body flex flex-col gap-4">
                                            <span class="font-semibold text-lg leading-tight">Groups:</span>
                                            @forelse(Auth::user()->student->groups()->get() as $group)
                                                <div class="bg-white p-2 mt-2 shadow-lg rounded-lg ">
                                                    <div class="flex justify-between items-center">
                                                    <span class="text-lg leading-tight">
                                                        {{$group->designation}}
                                                    </span>
                                                        <button
                                                            type="button"
                                                            data-mdb-ripple="true"
                                                            data-mdb-ripple-color="light"
                                                            data-bs-toggle="collapse" data-bs-target="#groupcollapse{{$loop->iteration}}" aria-expanded="false" aria-controls="groupcollapse{{$loop->iteration}}">
                                                            <ion-icon
                                                                class="p-2 text-blue-500 font-medium text-lg  uppercase rounded hover:bg-blue-500 hover:text-white focus:bg-blue-700 focus:text-white focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                                                                name="arrow-down-outline"></ion-icon>
                                                        </button>
                                                    </div>


                                                    <div class="collapse flex flex-col" id="groupcollapse{{$loop->iteration}}">
                                                        <a href="{{route('assignments.redirect',$group->id)}}"
                                                           class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                                            Assignments
                                                        </a>
                                                        <a href="{{route('groups.subjects.lessons.redirect',$group->id)}}"
                                                           class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                                            Lessons
                                                        </a>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="self-center">
                                                    <x-bladewind.empty-state
                                                        message="You have not created any groups as of yet."
                                                        image="{{asset('bladewind/images/no-code.svg')}}"
                                                        button_label="Create a group"
                                                        onclick="location.href='/groups'">
                                                    </x-bladewind.empty-state>
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



