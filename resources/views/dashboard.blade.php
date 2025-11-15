@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">
            Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-pink-400">{{ Auth::user()->name }}</span>
        </h1>
        <p class="text-gray-400">Manage your slambook profile and express yourself</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg p-6 shadow-lg shadow-blue-600/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-200 text-sm font-medium">Profile Status</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $slambook ? 'Complete' : 'Incomplete' }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/30 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-700 to-red-400 rounded-lg p-6 shadow-lg shadow-red-600/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-200 text-sm font-medium">Member Since</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ Auth::user()->created_at->format('M Y') }}</p>
                </div>
                <div class="w-12 h-12 bg-red-500/30 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-700 to-yellow-400 rounded-lg p-6 shadow-lg shadow-yellow-600/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-200 text-sm font-medium">Last Updated</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $slambook ? $slambook->updated_at->diffForHumans() : 'Never' }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/30 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if ($slambook)
    <!-- Slambook Profile Card -->
    <div class="bg-[#0d1135] border border-[#1a1f4a] rounded-lg overflow-hidden shadow-xl">
        <!-- Card Header -->
        @include('layouts.header', ['title' => 'Your Slambook Profile', 'subtitle' => 'Personal information and preferences'])

        <!-- Card Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Item -->
                <div class="bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e] hover:border-blue-500/50 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-blue-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Name</p>
                            <p class="text-white font-medium mt-1">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e] hover:border-blue-500/50 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-purple-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Age</p>
                            <p class="text-white font-medium mt-1">{{ $slambook->age }} years old</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e] hover:border-blue-500/50 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-indigo-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Zodiac Sign</p>
                            <p class="text-white font-medium mt-1">{{ $slambook->zodiac_sign }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e] hover:border-blue-500/50 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-pink-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Relationship Status</p>
                            <p class="text-white font-medium mt-1">{{ $slambook->in_relationship ? 'In a Relationship' : 'Single' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e] hover:border-blue-500/50 transition-all duration-200 md:col-span-2">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Dream Job</p>
                            <p class="text-white font-medium mt-1">{{ $slambook->dream_job }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e] hover:border-blue-500/50 transition-all duration-200 md:col-span-2">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-yellow-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Motto in Life</p>
                            <p class="text-white font-medium mt-1 italic">"{{ $slambook->motto }}"</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e] hover:border-blue-500/50 transition-all duration-200 md:col-span-2">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-cyan-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Describe Yourself in 3 Words</p>
                            <p class="text-white font-medium mt-1">{{ $slambook->three_words }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metadata -->
            <div class="mt-6 pt-6 border-t border-[#1a1f4a]">
                <p class="text-xs text-gray-500">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Created on {{ $slambook->created_at->format('F j, Y \a\t g:i A') }}
                    </span>
                    @if ($slambook->created_at != $slambook->updated_at)
                    <span class="mx-2">•</span>
                    <span class="inline-flex items-center">
                        Last updated {{ $slambook->updated_at->diffForHumans() }}
                    </span>
                    @endif
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex flex-wrap gap-3">
                <x-button :href="route('slambook.edit', $slambook->id)" variant="primary" tag="a">
                    <x-slot:icon>
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </x-slot:icon>
                    Edit Slambook
                </x-button>

                <form method="POST" action="{{ route('slambook.destroy', $slambook->id) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger" onclick="return confirm('Are you sure you want to reset your slambook? This action cannot be undone.');">
                        <x-slot:icon>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </x-slot:icon>
                        Reset Slambook
                    </x-button>
                </form>
            </div>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-[#0d1135] border border-[#1a1f4a] rounded-lg overflow-hidden shadow-xl">
        <div class="p-12 text-center">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">No Slambook Yet</h3>
            <p class="text-gray-400 mb-6 max-w-md mx-auto">
                You haven't created your slambook profile yet. Start now and share your story with others!
            </p>
            <x-button :href="route('slambook.start')" variant="gradient" size="lg" tag="a" color="cyan">
                <x-slot:icon>
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </x-slot:icon>
                Create Your Slambook
            </x-button>
        </div>  
    </div>
    @endif
</div>
@endsection