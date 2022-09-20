<x-app-layout>
    <x-slot name="modal">

    </x-slot>
    <x-error-message/>
    <div class="flex-col flex gap-2 mb-2">

        @forelse($lessons as $lesson)

            <div class="relative w-[90%] p-6 mx-auto shadow-lg rounded-lg bg-white text-gray-700">
                <a href="{{route('groups.subjects.lessons.show',[$group->id,$subject->id,$lesson->id])}}"
                   class="font-semibold text-3xl mb-5 hover:border-b-2">
                    {{$lesson->title}}
                </a>
                <hr class="my-6 border-gray-300" />
                <div class="flex flex-wrap p-6 rounded-lg shadow-lg bg-white justify-start items-center">
                    <h2>Attachments: </h2>
                    @foreach($lesson->attachments as $attachment)
                        <div class="ml-2 bg-gray-200/80 px-2 py-2.5 rounded-3xl">
                            <a href="{{route('download',$attachment->id)}}">
                                {{$attachment->filename}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <x-bladewind.empty-state
                message="It's your lucky day no lessons have been posted so no revision today is needed."
                image="{{asset('bladewind/images/Studying-bro.svg')}}">
            </x-bladewind.empty-state>
        @endforelse
    </div>

    <x-slot name="header">
        <div class="flex gap-2">
            @foreach(Auth::user()->student->groups()->get() as $Group)
                <x-nav-link href="{{route('groups.subjects.lessons.redirect',[$Group->id])}}" active="{{request()->routeIs('groups.subjects.lessons.index') and $Group->id==$group->id ? true : false}}">
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
                                        href="{{route('groups.subjects.lessons.index',[$group->id,$Subject->id])}}"
                                    >{{$Subject->designation}}</a
                                    >
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </x-slot>
</x-app-layout>

