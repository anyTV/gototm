<div class="header">
    @if (Session::has('auth.user.first_name'))
        <span class="header-item">
            Hello,  {{ Session::get('auth.user.first_name') }}
        </span>
        <a class="header-item" href="/au/logout">Logout</a>
    @else
        <a class="header-item" href="/au">Login</a>
    @endif
</div>
