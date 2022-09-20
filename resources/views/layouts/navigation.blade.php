
<div class="navigation ">
    <div class="logo">
        <div class="toggle">
            <ion-icon name="menu-outline" class="open"></ion-icon>
            <ion-icon name="close-outline" class="close"></ion-icon>
        </div>
        <span class="title font-medium">Grade Online</span>
    </div>
    <ul>
        <li class="list {{request()->routeIs('dashboard') ? 'active':''}}">
            <x-nav-button title="Dashboard" href="{{route('dashboard')}}" icon="grid-outline"/>
        </li>
        <li class="list {{request()->routeIs('groups.index') ? 'active':''}}">
            <x-nav-button title="Groups" href="{{route('groups.index')}}" icon="school-outline"/>
        </li>
        <li class="list {{request()->routeIs('notifications') ? 'active':''}}">
            <x-nav-button title="Notifications" href="{{route('notifications')}}" icon="notifications-outline"/>
        </li>
        @role('teacher')
            <li class="list {{request()->routeIs('group.requests') ? 'active':''}}">
                <x-nav-button title="Requests" href="{{route('requests.redirect')}}" icon="clipboard-outline"/>
            </li>

            <li class="list {{request()->routeIs('group.uploads') ? 'active':''}}">
                <x-nav-button title="Uploads" href="{{route('uploads.redirect')}}" icon="cloud-upload-outline"/>
            </li>
        @endrole
        <li class="list {{request()->routeIs('groups.subjects.assignments.index') ? 'active':''}}">
            <x-nav-button title="Assignments" href="{{route('assignments.redirect')}}" icon="document-outline"/>
        </li>
        <li class="list {{request()->routeIs('groups.subjects.lessons.index') ? 'active':''}}">
            <x-nav-button title="Lessons" href="{{route('groups.subjects.lessons.redirect')}}" icon="file-tray-full-outline"/>
        </li>
        <hr>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li class="list">
                <x-nav-button title="Logout" icon="log-out-outline" :href="route('logout')"
                              onclick="event.preventDefault();
                          this.closest('form').submit();"/>
            </li>

        </form>
    </ul>
</div>

</div>
