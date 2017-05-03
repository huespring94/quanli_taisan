<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
                <a href="#"> {{Auth::user()->role->name}}</a>
            </div>
        </div>
        </br>
        @if (Auth::user()->role->name == Config::get('constant.r_admin'))
        @include ('layouts.left-bar-admin')
        
        @elseif (Auth::user()->role->name == Config::get('constant.r_accountant'))
        @include ('layouts.left-bar-acc')

        @elseif (Auth::user()->role->name == Config::get('constant.r_faculty'))
        @include ('layouts.left-bar-fac')

        @elseif (Auth::user()->role->name == Config::get('constant.r_room'))
        @include ('layouts.left-bar-room')

        @endif

    </section>
</aside>