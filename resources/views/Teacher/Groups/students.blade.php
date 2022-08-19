<x-app-layout>

    <x-slot name="modal">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-3 gap-2">
        @foreach($groups->slice(0,3) as $group)
                <div class="bg-white grid grid-rows-1">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight ">
                        {{$group->designation}}
                    </h3>
                    @if($group->students->isNotEmpty())
                        @foreach($group->students->slice(0,10) as $student)
                        <div>
                                {{$student->firstName}}
                        </div>
                        @endforeach
                    @else
                        Nothing to see here
                    @endif

                </div>
        @endforeach
    </div>
</x-app-layout>
