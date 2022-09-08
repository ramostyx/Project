<x-app-layout>
    <x-slot name="modal">

    </x-slot>
    <x-error-message/>
    <div class="flex-col flex gap-2 mb-2">

        @foreach($assignments as $assignment)
            <!-- Jumbotron -->
            <div class="relative w-[90%] p-6 mx-auto shadow-lg rounded-lg bg-white text-gray-700">
                <div class="absolute top-3 right-3">
                    <form action="{{route('groups.subjects.assignments.destroy',[$group->id,$subject->id,$assignment->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-none" >
                            <ion-icon name="trash-outline" class="p-4 text-lg hover:bg-red-100 rounded-lg"></ion-icon>
                        </button>
                    </form>
                </div>
                <div class="absolute top-3 right-12 mr-3">
                    <form action="{{route('groups.subjects.assignments.edit',[$group->id,$subject->id,$assignment->id])}}" method="GET">
                        @csrf
                        <button class="bg-none" >
                            <ion-icon name="create-outline" class="p-4 text-lg hover:bg-green-100 rounded-lg"></ion-icon>
                        </button>
                    </form>
                </div>
                <h2 class="font-semibold text-3xl mb-5">{{$assignment->title}}</h2>
                <p class="break-words">
                    {{$assignment->body}}
                </p>
                <hr class="my-6 border-gray-300" />
                <button
                    type="button"
                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                    data-mdb-ripple="true"
                    data-mdb-ripple-color="light"
                    data-bs-toggle="collapse" data-bs-target="#downloadcollapse{{$loop->iteration}}" aria-expanded="false" aria-controls="downloadcollapse{{$loop->iteration}}">

                    Download
                    <ion-icon  name="caret-down-outline"></ion-icon>
                </button>

                <div class="collapse" id="downloadcollapse{{$loop->iteration}}">
                    <div class="flex flex-wrap p-6 rounded-lg shadow-lg bg-white justify-start items-center">
                        <h2>Attachments: </h2>
                        @foreach($assignment->attachments as $attachment)
                            <div class="ml-2 bg-gray-200/80 px-2 py-2.5 rounded-3xl">
                                <a href="{{route('download',$attachment->id)}}">
                                    {{$attachment->filename}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button class=" mt-3 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->iteration}}" aria-expanded="false" aria-controls="collapse{{$loop->iteration}}">
                    Comments
                    <ion-icon  name="caret-down-outline"></ion-icon>
                </button>
                <div class="collapse mt-10" id="collapse{{$loop->iteration}}">
                    <div class="px-3 py-2.5 p-4 ">
                        Comments:
                    </div>
                    @foreach($assignment->comments as $comment)
                        <div class="mt-2 p-2 rounded-tr-lg rounded-b-lg shadow-lg bg-white">
                            <div class="flex flex-wrap w-full justify-between items-center">
                                <div>
                                    <span class="font-bold">{{$comment->user->fullName()}}:</span>
                                    {{$comment->body}}
                                </div>
                                @if(Auth::user()->id==$comment->user->id)
                                    <div class="flex gap-2">
                                        <form action="{{route('comment.delete',$comment->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-none" >
                                                <ion-icon name="trash-outline" class="p-4 text-lg hover:bg-red-100 rounded-lg"></ion-icon>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <form action="{{route('assignment.comment.post',$assignment->id)}}" method="POST">
                        @csrf
                        <input
                            name="comment"
                            type="text"
                            class="form-control block w-full mt-2 px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            id="comment"
                            placeholder="Make a Comment"
                        />
                        <div class="flex items-center justify-end mt-2 ">
                            <x-button class="ml-4" >
                                {{ __('post') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <!-- Jumbotron -->
    @endforeach
    </div>

    <x-slot name="header">

        <div class="flex gap-2">
            @foreach(Auth::user()->student->groups as $Group)
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

                <x-button class="ml-4" >
                    <a href="{{route('groups.subjects.assignments.create',[$group->id,$subject->id])}}">
                        {{ __('Create a New Assignment') }}
                    </a>
                </x-button>
            </div>
        </div>
    </x-slot>
</x-app-layout>

