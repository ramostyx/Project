<x-app-layout>
    <x-slot name="modal">

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            Grades
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="flex flex-wrap justify-between">
                                    <form action="{{route('grades.search',[$group->id,$semester,$evaluation])}}" method="GET">
                                            <x-input type="text"
                                                     class="form-control block w-fit px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                     placeholder="search" name="search" />
                                    </form>

                                    <div>
                                        <form action="{{route('grades',[$group->id,$semester,$evaluation])}}" method="GET">
                                            <div class="flex items-center justify-end gap-2 py-1.5 ">
                                                <div class="flex gap-2 flex-wrap items-center">
                                                    <x-label class="" for="semester" :value="__('Semester:')" />
                                                    <select id="semester" name="semester">
                                                        <option {{$semester=="1st semester" ? 'selected' : ''}} value="1st semester">1st Semester</option>
                                                        <option {{$semester=="2nd semester" ? 'selected' : ''}} value="2nd semester">2nd Semester</option>
                                                    </select>
                                                </div>
                                                <div class="flex gap-2 items-center">
                                                    <x-label for="evaluation" :value="__('Evaluation:')" />
                                                    <select id="evaluation" name="evaluation">
                                                        <option disabled value="">options:</option>
                                                        <option {{$evaluation=="1st evaluation" ? 'selected' : ''}} value="1st evaluation">1st Evaluation</option>
                                                        <option {{$evaluation=="2nd evaluation" ? 'selected' : ''}} value="2nd evaluation">2nd Evaluation</option>
                                                    </select>
                                                </div>
                                                <x-button class="ml-4">
                                                    {{ __('Go') }}
                                                </x-button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                <div class="card-body">
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
                                                            @foreach($group->subject as $subject)
                                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                    {{$subject->designation}}
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($students as $student)
                                                            <tr class="bg-white border-b">
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                    {{$loop->iteration}}
                                                                </td>
                                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                    {{$student->user->firstName}}
                                                                </td>
                                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                    {{$student->user->lastName}}
                                                                </td>
                                                                @foreach($group->subject as $subject)
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        {{App\Models\Grade::findGradeorReplace($subject->id,$student->id,$semester,$evaluation,'_')}}
                                                                    </td>
                                                                @endforeach
                                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                    <div class="flex gap-2">
                                                                        <button type="submit" class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-gray-100 focus:text-blue-700 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 active:text-blue-800 transition duration-300 ease-in-out">
                                                                            <a href="{{route('grades.create',[$group->id,$student->id,$semester,$evaluation])}}">Edit</a>
                                                                        </button>
                                                                        <form action="{{route('grades.delete',[$group->id,$student->id,$semester,$evaluation])}}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-gray-100 focus:text-blue-700 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 active:text-blue-800 transition duration-300 ease-in-out">
                                                                                Delete
                                                                            </button>
                                                                        </form>

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

</x-app-layout>
