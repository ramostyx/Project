<x-app-layout>
    <x-slot name="modal">

    </x-slot>

    <x-slot name="header">
        <div class="flex gap-2">
            @foreach(Auth::user()->teacher->groups as $Group)
                <x-nav-link href="{{route('group.uploads',[$Group->id])}}" active="{{request()->routeIs('group.uploads') and $Group->id==$group->id ? true : false}}">
                    {{ $Group->designation }}
                </x-nav-link>
            @endforeach
        </div>

        <h2 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assignment Uploads') }}
        </h2>
    </x-slot>

    <div class="mt-4">
        <div class="flex flex-wrap justify-between">
            <form action="" method="GET">
                <x-input type="text"
                         class="form-control block w-fit px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                         placeholder="search" name="search" />
            </form>

        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <x-success-message />
                    @if($students->isNotEmpty())
                        <table class="min-w-full">
                            <thead class="bg-white border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    First Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Last Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Assignment
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Status
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    download
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr class="bg-white border-b">
                                @foreach($student->assignments as $assignment)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{($students->currentpage()-1) * $students->perpage() + $loop->parent->index + 1}}
                                        </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$student->user->firstName}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$student->user->lastName}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$assignment->title}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex gap-1 items-center">
                                        {{$assignment->pivot->status}}
                                    </td>


                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <div class="flex gap-2">
                                            <form action="{{route('work.download')}}" method="POST">
                                                @csrf
                                                <input name="path" type="hidden" value="{{$assignment->pivot->file}}">
                                                <button type="submit" {{$assignment->pivot->status=='turned in' ? '':'disabled'}} class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-gray-100 focus:text-blue-700 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 active:text-blue-800 transition duration-300 ease-in-out">
                                                    Download
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
            @else
                No students
            @endif
            {{$students->links()}}
        </div>
    </div>






</x-app-layout>
