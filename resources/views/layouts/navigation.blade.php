<nav class="navbar">
    <ul>
        <li><a href="/">Dashboard</a></li>
        @if (!$slambook)
        <li><a href="{{ route('slambook.start') }}">Create Slambook</a></li>
        @endif
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>
</nav>
<form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
    @csrf
</form>