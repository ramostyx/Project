<x-auxiliary-layout>
    <x-slot name="nav">
        @include('layouts.list')
    </x-slot>
    <x-slot name="header">
            <a href="{{route('grades.create',[$group->id,$Student->back($group->id),$semester,$evaluation])}}">
                <ion-icon class="text-5xl" name="chevron-back-outline"></ion-icon>
            </a>
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{$Student->user->firstName}} {{$Student->user->lastName}}
        </h2>
        <a href="{{route('grades.create',[$group->id,$Student->next($group->id),$semester,$evaluation])}}">
            <ion-icon class="text-5xl" name="chevron-forward-outline"></ion-icon>
        </a>
    </x-slot>

    <form action="{{route('grades.create',[$group->id,$Student->id])}}" method="GET" class="flex flex-grow">
        <div class="flex flex-col items-start gap-2 mb-1 ">
            <div class="flex gap-2 flex-wrap items-center">
                <x-label class="" for="semester" :value="__('Semester:')" />
                <select id="semester" name="semester">
                    <option {{$semester=="1st semester" ? 'selected' : ''}} value="1st semester">1st Semester</option>
                    <option {{$semester=="2nd semester" ? 'selected' : ''}} value="2nd semester">2nd Semester</option>
                </select>
            </div>
            <div class="flex gap-2 items-center mt-1">
                <x-label for="evaluation" :value="__('Evaluation:')" />
                <select id="evaluation" name="evaluation">
                    <option {{$evaluation=="1st evaluation" ? 'selected' : ''}} value="1st evaluation">1st Evaluation</option>
                    <option {{$evaluation=="2nd evaluation" ? 'selected' : ''}} value="2nd evaluation">2nd Evaluation</option>
                </select>
            </div>
        </div>
        <x-button class="ml-4 self-center">
            {{ __('Change') }}
        </x-button>
    </form>


    <div class="pb-12">
        <div class="max-w-fit sm:px-6 lg:px-8">
            <div class="bg-none overflow-hidden ">
                <div class="py-6 bg-none ">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body max-w-full">
                                        <h2 class="font-semibold text-3xl mb-5">Grades</h2>
                                        <hr class="my-6 border-gray-600/40 rounded-xl" />
                                        <form method="POST" action="{{ route('grades.store',[$group->id,$Student->id])}}">
                                            @csrf
                                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                                @foreach($group->subject as $subject)
                                                    <div class="w-96">
                                                        <x-label for="{{$subject->designation}}" value="{{$subject->designation}}" />
                                                        <input
                                                            name="{{$subject->designation}}"
                                                            type="number"
                                                            min="0" max="20" step="0.01"
                                                            value="{{\App\Models\Grade::findGradeorReplace($subject->id,$Student->id,$semester,$evaluation)}}"
                                                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                            id="{{$subject->designation}}"
                                                        />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <input type="hidden" name="semester" value="{{$semester}}"/>
                                            <input type="hidden" name="evaluation" value="{{$evaluation}}"/>
                                            <hr class="my-6 border-gray-600/40 rounded-xl" />
                                            <div class="flex items-center justify-end mt-8 ">
                                                <x-button class="ml-4" >
                                                    {{ __('Save') }}
                                                </x-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-auxiliary-layout>
