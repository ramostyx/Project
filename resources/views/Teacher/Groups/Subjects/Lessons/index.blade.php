<x-app-layout>
    <x-slot name="modal">

    </x-slot>
    <x-error-message/>
    <div class="flex-col flex gap-2 mb-2">

        @forelse($lessons as $lesson)

            <div class="relative w-[90%] p-6 mx-auto shadow-lg rounded-lg bg-white text-gray-700">
                <div class="absolute top-3 right-3">
                    <form action="{{route('groups.subjects.lessons.destroy',[$group->id,$subject->id,$lesson->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-none" >
                            <ion-icon name="trash-outline" class="p-4 text-lg hover:bg-red-100 hover:text-red-400 rounded-lg"></ion-icon>
                        </button>
                    </form>
                </div>
                <div class="absolute top-3 right-12 mr-3">
                    <form action="{{route('groups.subjects.lessons.edit',[$group->id,$subject->id,$lesson->id])}}" method="GET">
                        @csrf
                        <button class="bg-none" >
                            <ion-icon name="create-outline" class="p-4 text-lg hover:bg-green-100 hover:text-green-500 rounded-lg"></ion-icon>
                        </button>
                    </form>
                </div>
                <a href="{{route('groups.subjects.lessons.show',[$group->id,$subject->id,$lesson->id])}}"
                   class="font-semibold text-3xl mb-5 hover:border-b-2">
                    {{$lesson->title}}
                </a>
                <hr class="my-6 border-gray-300" />
                @if($lesson->attachments->first())
                    <div class="flex flex-wrap p-6 rounded-lg shadow-lg bg-white justify-start items-center">
                        <h2>Attachments: </h2>
                        @foreach($lesson->attachments as $attachment)
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
                @endif
            </div>
        @empty
            <x-bladewind.empty-state
                message="Post some lessons for your students to study."
                image="{{asset('bladewind/images/Learning-bro.svg')}}">
            </x-bladewind.empty-state>

        @endforelse
    </div>

    <x-slot name="header">
        <div class="flex gap-2">
            @foreach(Auth::user()->teacher->groups as $Group)
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
            <div class="">
                <x-button class="ml-4" >
                    <a href="{{route('groups.subjects.lessons.create',[$group->id,$subject->id])}}">
                        {{ __('Post a New Lesson') }}
                    </a>
                </x-button>
            </div>
        </div>
    </x-slot>
</x-app-layout>

