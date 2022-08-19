
<div class="navigation ">
    <div class="logo">
        <div class="toggle">
            <ion-icon name="menu-outline" class="open"></ion-icon>
            <ion-icon name="close-outline" class="close"></ion-icon>
        </div>
        <span class="title font-medium">Project</span>
    </div>
    <ul>
        <li class="list active">
            <x-nav-button title="Home" href="{{route('groups.index')}}" icon="home-outline"/>
        </li>
        <li class="list">
            <x-nav-button title="Profile" href="#" icon="person-outline"/>
        </li>
        <li class="list">
            <x-nav-button title="Message" href="#" icon="chatbubbles-outline"/>
        </li>
        <li class="list">
            <x-nav-button title="Settings" href="#" icon="settings-outline"/>
        </li>
        <li class="list">
            <x-nav-button title="Password" href="#" icon="lock-closed-outline"/>
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
