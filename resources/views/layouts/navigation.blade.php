<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand">
            <a href="/">
                <svg class="brand-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9 9H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M9 13H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M9 17H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                <span class="brand-text">My Slambook</span>
            </a>
        </div>
        <ul class="navbar-menu">
            <li><a href="/">Dashboard</a></li>
            @if (!$slambook)
            <li><a href="{{ route('slambook.start') }}">Create Slambook</a></li>
            @endif
            <li class="logout-item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg class="logout-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
<form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
    @csrf
</form>