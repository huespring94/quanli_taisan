<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset(config('path.user').Auth::user()->avatar)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->lastname}} {{Auth::user()->firstname}}</p>
                <a href="#"> {{Auth::user()->role->name}}</a>
            </div>
        </div>
        </br>
        @if (Auth::user()->role->name == Config::get('constant.r_admin') || Auth::user()->role->name == Config::get('constant.r_accountant'))
        @include ('layouts.left-bar-admin')

        @elseif (Auth::user()->role->name == Config::get('constant.r_faculty'))
        @include ('layouts.left-bar-fac')

        @elseif (Auth::user()->role->name == Config::get('constant.r_room'))
        @include ('layouts.left-bar-room')

        @endif

    </section>
</aside>