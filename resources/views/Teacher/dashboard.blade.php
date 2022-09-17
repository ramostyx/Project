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
                        <span class="font-semibold text-lg leading-tight">New Assignment Uploads:</span>
                        <a href="{{route('requests.redirect')}}">see all</a>
                    </div>

                    <div class="mt-2 flex flex-col gap-2">
                        @forelse($assignments->take(-4) as $assignment)
                            @if($uploads)
                                @foreach($assignment->students()->get()->take(2) as $student)
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
                                                                <span class="flex gap-2 justify-center items-center">
                                                                    {{$student->user->fullName()}}
                                                                </span>
                                                                <span class="flex gap-2 justify-center items-center {{$student->pivot->status=='turned in' ? 'text-green-500':'text-red-500'}}">
                                                                    {{$student->pivot->status}}
                                                                </span>
                                                                <div class="mr-12 flex gap-2 font-light text-sm">
                                                                    {{$student->pivot->created_at->translatedFormat('H:i') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-12 mx-auto">
                                    <x-bladewind.empty-state
                                        message="Your students are lazy no turned in assignments have been found."
                                        image="{{asset('bladewind/images/No- data-amico.svg')}}">
                                    </x-bladewind.empty-state>
                                </div>
                            @endif
                        @empty
                            <div class="p-12 mx-auto">
                                <x-bladewind.empty-state
                                    message="No assignments have been found you have to issue one first to check out the related uploaded work."
                                    image="{{asset('bladewind/images/No- data-amico.svg')}}">
                                </x-bladewind.empty-state>
                            </div>
                        @endforelse
                    </div>

                </div>



                <div class="mt-8 flex flex-col gap-2">
                    <div class="flex justify-between">
                        <span class="font-semibold text-lg leading-tight">New Join Requests:</span>
                        <a href="{{route('requests.redirect')}}">see all</a>
                    </div>
                    @forelse(Auth::user()->teacher->groups as $group)
                        @if($requests)
                            @foreach($group->students('pending')->get()->take(2) as $student)
                                <div class="bg-white hover:shadow-xl hover:shadow-gray-400/80 hover:translate-y-2 ease-in-out overflow-hidden shadow-sm rounded-md ">
                                    <div class="p-3 bg-white">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body flex justify-between items-center">
                                                            <div class=" flex flex-col gap-1">
                                                                <span>
                                                                    {{$group->designation}}
                                                                </span>
                                                                <span class="text-sm font-light">
                                                                    {{$student->pivot->created_at->translatedFormat('j F') }}
                                                                </span>
                                                            </div>
                                                            <span class="flex gap-2 justify-center items-center">
                                                                <x-status class="w-2 h-2" status="{{$student->user->status}}"/>
                                                                {{$student->user->fullName()}}
                                                            </span>
                                                            <div class="mr-12 flex gap-2">
                                                                <form action="{{route('groups.students.accept',[$group->id,$student->id])}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                            class="inline-block px-6 py-2.5 bg-transparent text-green-600 font-medium text-xs leading-tight uppercase rounded hover:bg-green-100 focus:text-green-700 focus:bg-green-100 focus:outline-none focus:ring-0 active:bg-green-200 active:text-green-800 transition duration-300 ease-in-out">

                                                                        Accept
                                                                    </button>
                                                                </form>
                                                                <form action="{{route('groups.students.reject',[$group->id,$student->id])}}" method="POST">
                                                                    @csrf
                                                                    <button
                                                                        type="submit"
                                                                        class="inline-block px-6 py-2.5 bg-transparent text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-red-100 focus:text-red-700 focus:bg-red-100 focus:outline-none focus:ring-0 active:bg-red-200 active:text-red-800 transition duration-300 ease-in-out">
                                                                        Deny
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-12 mx-auto">
                                <x-bladewind.empty-state
                                    message="No new joining requests have been issued."
                                    image="{{asset('bladewind/images/Empty-amico.svg')}}">
                                </x-bladewind.empty-state>
                            </div>
                            @break
                        @endif
                    @empty
                        <div class="mx-auto">
                            <x-bladewind.empty-state
                                message="You have to create a group first and share the code with your students to see related joining requests"
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
                                        @forelse(Auth::user()->teacher->groups as $group)
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
                                                    <a href="{{route('group.details',$group->id)}}"
                                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                                        Details
                                                    </a>
                                                    <a href="{{route('grades',$group->id)}}"
                                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                                        Grades
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
