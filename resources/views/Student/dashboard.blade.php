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
                                            @foreach(Auth::user()->student->latestAssignments()->take(-2) as $assignment)
                                            <div class="bg-indigo-100 p-2 shadow-lg rounded-lg ">
                                                <div class="flex justify-between text-xl">
                                                    <span class="text-lg leading-tight">
                                                        {{$assignment->subject->group->designation}}->{{$assignment->subject->designation}}
                                                    </span>
                                                    <a href="{{route('groups.subjects.assignments.index',[$assignment->subject->group->id,$assignment->subject->id])}}">
                                                        <ion-icon name="arrow-forward-outline"></ion-icon>
                                                    </a>
                                                </div>
                                                <div class="bg-white my-1 p-2 rounded-xl ">
                                                    <h2 class="font-semibold leading-tight pt-2">
                                                        {{$assignment->title}}
                                                    </h2>
                                                    <hr>
                                                    <div class="py-2">
                                                        {{$assignment->body}}
                                                    </div>
                                                </div>
                                            </div>
                                           @endforeach
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
                                        <span class="font-semibold text-lg text-gray-400 leading-tight">New Lessons:</span>
                                        @forelse(Auth::user()->student->latestLessons()->take(-3) as $lesson)
                                            <div class="bg-purple-300/80 p-2 mt-2 shadow-lg rounded-lg ">
                                                <div class="flex justify-between text-xl">
                                                    <span class="text-lg leading-tight">
                                                        {{$lesson->subject->group->designation}}->{{$lesson->subject->designation}}
                                                    </span>
                                                    <a href="{{route('groups.subjects.lessons.index',[$lesson->subject->group->id,$lesson->subject->id])}}">
                                                        <ion-icon name="arrow-forward-outline"></ion-icon>
                                                    </a>
                                                </div>
                                                <div class="bg-white my-1 p-2 rounded-xl ">
                                                    <h2 class="leading-tight py-2">
                                                        {{$lesson->title}}
                                                    </h2>
                                                </div>
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
