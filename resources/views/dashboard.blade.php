<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="#" method="GET">
                                            <x-input type="text"
                                                     class="form-control block w-1/4 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                     placeholder="search" name="search" />
                                        </form>
                                        <div class="flex flex-col">
                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                                    <div class="overflow-hidden">
                                                        <table class="min-w-full">
                                                            <thead class="bg-white border-b">
                                                            <tr>
                                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                    #
                                                                </th>
                                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                    code
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
                                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                    Niveau
                                                                </th>
                                                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                                    Filiere
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="bg-white border-b">
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                        1
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        149546
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        Yami
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        Sukihiro
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        test@gmail.com
                                                                    </td>

                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        First Year
                                                                    </td>
                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        Computer Science
                                                                    </td>

                                                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                        <div class="grid grid-cols-2 gap-2">
                                                                            <button type="submit" value="delete"
                                                                                    data-mdb-ripple="true"
                                                                                    data-mdb-ripple-color="light"
                                                                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg hover:bg-green-600 focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                                                <a href="#">Edit</a>
                                                                            </button>
                                                                            <form action="#" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" value="delete"
                                                                                        data-mdb-ripple="true"
                                                                                        data-mdb-ripple-color="light"
                                                                                        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg hover:bg-red-600 focus:bg-red-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                                                    Delete
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
