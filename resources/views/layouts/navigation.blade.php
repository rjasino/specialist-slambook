<!-- Vertical Sidebar Navigation -->
<aside class="w-64 bg-[#0d1135] border-r border-[#1a1f4a] flex flex-col">
    <!-- Logo/Brand Section -->
    <div class="p-6 border-b border-[#1a1f4a]">
        <h1 class="text-2xl font-bold text-white-700">
            Slambook
        </h1>
        <p class="text-xs text-gray-500 mt-1">Specialist Project</p>
    </div>

    <!-- User Info -->
    <div class="px-6 py-4 border-b border-[#1a1f4a]">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-3 py-6 space-y-1">
        <a href="/" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->is('/') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/50' : 'text-gray-300 hover:bg-[#1a1f4a] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        @if (!$slambook)
        <a href="{{ route('slambook.start') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('slambook.start') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/50' : 'text-gray-300 hover:bg-[#1a1f4a] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Create Slambook
        </a>
        @endif

        <a href="{{ route('contact.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('contact.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/50' : 'text-gray-300 hover:bg-[#1a1f4a] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Contact Us
        </a>
    </nav>

    <!-- Logout Section -->
    <div class="p-3 border-t border-[#1a1f4a]">
        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                class="w-full flex items-center px-3 py-2.5 text-sm font-medium text-red-400 hover:bg-red-600/10 hover:text-red-300 rounded-lg transition-all duration-200">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Logout
        </button>
    </div>
</aside>

<form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
    @csrf
</form>