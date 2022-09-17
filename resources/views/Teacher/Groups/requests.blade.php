<x-app-layout>
    <x-slot name="modal">

    </x-slot>

    <x-slot name="header">
        <div class="flex gap-2">
            @foreach(Auth::user()->teacher->groups as $Group)
                <x-nav-link href="{{route('group.requests',[$Group->id])}}" active="{{request()->routeIs('group.requests') and $Group->id==$group->id ? true : false}}">
                    {{ $Group->designation }}
                </x-nav-link>
            @endforeach
        </div>

        <h2 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Requests') }}
        </h2>
    </x-slot>

    <div class="mt-4">
        <div class="flex flex-wrap justify-between">
            <form action="" method="GET">
                <x-input type="text"
                         class="form-control block w-fit px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                         placeholder="search" name="search" />
            </form>

            <div class="flex gap 2">
                <form action="{{route('group.acceptAll',$group->id)}}" method="POST">
                    @csrf
                    <button type="submit"
                    class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-gray-100 focus:text-blue-700 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 active:text-blue-800 transition duration-300 ease-in-out">
                        Accept All
                    </button>
                </form>
                <form action="{{route('group.rejectAll',$group->id)}}" method="POST">
                    @csrf
                    <button type="submit"
                            class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-gray-100 focus:text-blue-700 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 active:text-blue-800 transition duration-300 ease-in-out">
                        Deny All
                    </button>
                </form>
            </div>
        </div>
    </div>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach($students as $student)
                    <div class="bg-white max-w-5xl mx-auto overflow-hidden shadow-sm sm:rounded-lg mb-2">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body flex justify-between items-center">
                                                <div class=" flex flex-col gap-1">
                                                    <span class="text-sm font-light">
                                                        {{$student->pivot->created_at->translatedFormat('j F') }}
                                                    </span>
                                                    <span class="text-sm font-light">
                                                        {{$student->pivot->created_at->translatedFormat('H:i') }}
                                                    </span>
                                                </div>
                                                {{$student->user->fullName()}}
                                                <div class="flex gap-2">
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
            </div>
        </div>
    </div>






</x-app-layout>
