<x-app-layout>
    <x-slot name="modal">
        <x-bladewind.modal
            name="create-subject" size="large" title="Subject Creation Form"
            show_action_buttons="false">
            <div class="overflow-hidden mt-2">
                <form method="POST" action="{{ route('groups.subjects.store',$group->id)}}">
                    @csrf
                    <x-label for="designation" :value="__('Designation')" />
                    <input
                        type="text"
                        name="designation"
                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="designation"
                        required
                    />
                    <div class="flex items-center justify-end mt-8 ">
                        <x-button class="ml-4" >
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-bladewind.modal>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subjects') }}
        </h2>
    </x-slot>
    <div class="flex items-center justify-start mt-6 ">
        <x-button class="mb-2" onclick="showModal('create-subject')">
            {{ __('Create a new subject') }}
        </x-button>
    </div>
    <div class="flex flex-wrap justify-start gap-2">
    @foreach($subjects as $subject)
            <div>
                <div class="dropdown relative">
                    <a
                        class="
          dropdown-toggle
          ml-2 bg-gray-300 px-2 py-2.5 rounded-lg
        "
                        href="#"
                        type="button"
                        id="dropdownMenuButton2"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        {{$subject->designation}}
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
                                href="{{route('groups.subjects.assignments.index',[$group->id,$subject->id])}}"
                            >Assignments</a>
                        </li>
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
                                href="{{route('groups.subjects.lessons.index',[$group->id,$subject->id])}}"
                            >Lessons</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
    @endforeach
    </div>


    <h2 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Students') }}
    </h2>
    <div class="py-5">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="GET">
                                            <x-input type="text"
                                                     class="form-control block w-1/4 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                     placeholder="search" name="search" />
                                        </form>
                                        <div class="flex flex-col">
                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                                    <div class="overflow-hidden">
                                                        <x-success-message />
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
                                                                    Email
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($students as $student)
                                                                <tr class="bg-white border-b">
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                        {{$student->id}}
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        {{$student->user->firstName}}
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        {{$student->user->lastName}}
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        {{$student->user->email}}
                                                                    </td>

                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        <div class="flex gap-2">
                                                                            <button type="submit" class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-gray-100 focus:text-blue-700 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 active:text-blue-800 transition duration-300 ease-in-out">
                                                                                <a href="#">Ban</a>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{$students->links()}}
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
