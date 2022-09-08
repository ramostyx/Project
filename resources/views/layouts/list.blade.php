
<div class="navigation ">
    <div class="logo">
        <a class="toggle" href="{{route('groups.index')}}">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <span class="title font-medium">Go Back</span>
    </div>

    <hr>
    <ul class="mt-4">
        @foreach($group->students as $student)
            <li class="list {{$student->id==$Student->id ? 'active':''}}">
                <x-list-link name="{{$student->user->lastName}} {{$student->user->firstName}}" href="{{route('grades.create',[$group->id,$student->id])}}"/>
            </li>
        @endforeach
    </ul>
</div>
