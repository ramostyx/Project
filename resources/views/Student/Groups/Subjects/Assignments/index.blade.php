<x-app-layout>
    <x-slot name="modal">

    </x-slot>
    <x-error-message/>
    <div class="flex-col flex gap-2 mb-2">

        @forelse($assignments as $assignment)

            <div class="relative w-[90%] p-6 mx-auto shadow-lg rounded-lg bg-white text-gray-700">
                <div class="absolute top-3 right-3">
                    <button
                        type="button"
                        data-mdb-ripple="true"
                        data-mdb-ripple-color="light"
                        data-bs-toggle="collapse" data-bs-target="#downloadcollapse{{$loop->iteration}}" aria-expanded="false" aria-controls="downloadcollapse{{$loop->iteration}}">
                        <ion-icon
                            class="p-2 text-blue-500 font-medium text-lg  uppercase rounded hover:bg-blue-500 hover:text-white focus:bg-blue-700 focus:text-white focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                            name="arrow-down-outline"></ion-icon>
                    </button>
                </div>
                <a href="{{route('groups.subjects.assignments.show',[$group->id,$subject->id,$assignment->id])}}"
                   class="font-semibold text-3xl mb-5 hover:border-b-2">
                    {{$assignment->title}}
                </a>                <p class="break-words">
                    {{$assignment->body}}
                </p>
                <hr class="my-6 border-gray-300" />



                <div class="collapse" id="downloadcollapse{{$loop->iteration}}">
                    <div class="flex flex-wrap p-6 rounded-lg shadow-lg bg-white justify-start items-center">
                        <h2>Attachments: </h2>
                        @foreach($assignment->attachments as $attachment)
                            <div class="ml-2 bg-gray-200/80 px-2 py-2.5 rounded-3xl flex justify-start items-center">
                                <a href="{{route('download',$attachment->id)}}">
                                    {{$attachment->filename}}
                                </a>
                                <form method="POST" action="{{route('attachment.delete',$attachment->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button>
                                        <ion-icon  name="close-outline" class="hover:bg-gray-400 rounded-xl"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <x-bladewind.empty-state
                message="It's your lucky day your teacher has not assigned this group any homework today."
                image="{{asset('bladewind/images/Work in progress-bro.svg')}}">
            </x-bladewind.empty-state>
        @endforelse
    </div>

    <x-slot name="header">

        <div class="flex gap-2">
            @foreach(Auth::user()->student->groups()->get() as $Group)
                <x-nav-link href="{{route('assignments.redirect',[$Group->id])}}" active="{{request()->routeIs('groups.subjects.assignments.index') and $Group->id==$group->id ? true : false}}">
                    {{ $Group->designation }}
                </x-nav-link>
            @endforeach
        </div>

        <div class="flex justify-between">
            <div class="flex justify-start">
                <div>
                    <div class="dropdown relative">
                        <a
                            class="
              dropdown-toggle
              px-6
              py-2.5
              bg-transparent
            "
                            href="#"
                            type="button"
                            id="dropdownMenuButton2"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Subjects
                            <ion-icon name="chevron-down-outline"></ion-icon>
                        </a>
                        <ul
                            class="
              dropdown-menu
              min-w-max
              absolute
              hidden
              bg-white
              text-base
              z-50
              float-left
              py-2
              list-none
              text-left
              rounded-lg
              shadow-lg
              mt-1
              hidden
              m-0
              bg-clip-padding
              border-none" aria-labelledby="dropdownMenuButton2">
                            @foreach($group->subject as $Subject)
                                <li>
                                    <a
                                        class="
                  dropdown-item
                  text-sm
                  py-2
                  px-4
                  font-normal
                  block
                  w-full
                  whitespace-nowrap
                  bg-transparent
                  text-gray-700
                  hover:bg-gray-100
                "
                                        href="{{route('groups.subjects.assignments.index',[$group->id,$Subject->id])}}"
                                    >{{$Subject->designation}}</a
                                    >
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="">

            </div>
        </div>
    </x-slot>
</x-app-layout>

