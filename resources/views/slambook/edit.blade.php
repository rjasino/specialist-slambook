@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Edit Your Slambook</span>
        </h1>
        <p class="text-gray-400">Update your personal information and preferences</p>
    </div>

    <!-- Form Card -->
    <div class="bg-[#0d1135] border border-[#1a1f4a] rounded-lg overflow-hidden shadow-xl">
        <!-- Card Header -->
        @include('layouts.header', ['title' => 'Profile Information', 'subtitle' => 'Make changes to your slambook details'])

        <!-- Form Content -->
        <div class="p-6">
            <form method="POST" action="{{ route('slambook.update', $slambook->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name Field (Read-only) -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name', $name) }}" readonly
                               class="w-full bg-[#1a1f4a]/50 border border-[#252b5e] text-gray-400 rounded-lg pl-10 pr-4 py-3 cursor-not-allowed" />
                    </div>
                    <p class="text-xs text-gray-500">Name cannot be changed</p>
                </div>

                <!-- Age Field -->
                <div class="space-y-2">
                    <label for="age" class="block text-sm font-medium text-gray-300">Age</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input type="number" id="age" name="age" value="{{ old('age', $slambook->age) }}" min="1" max="120"
                               class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="Enter your age" required />
                    </div>
                </div>

                <!-- Zodiac Sign Field -->
                <div class="space-y-2">
                    <label for="zodiac_sign" class="block text-sm font-medium text-gray-300">Zodiac Sign</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <select id="zodiac_sign" name="zodiac_sign"
                                class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none" 
                                required>
                            @php
                            $zodiacSigns = [
                                'Aries' => '♈', 'Taurus' => '♉', 'Gemini' => '♊', 'Cancer' => '♋', 
                                'Leo' => '♌', 'Virgo' => '♍', 'Libra' => '♎', 'Scorpio' => '♏', 
                                'Sagittarius' => '♐', 'Capricorn' => '♑', 'Aquarius' => '♒', 'Pisces' => '♓'
                            ];
                            @endphp
                            @foreach ($zodiacSigns as $sign => $symbol)
                            <option value="{{ $sign }}" {{ old('zodiac_sign', $slambook->zodiac_sign) == $sign ? 'selected' : '' }} class="bg-[#1a1f4a]">
                                {{ $symbol }} {{ $sign }}
                            </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Relationship Status Field -->
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-300">In a Relationship</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" id="in_relationship_yes" name="in_relationship" value="1" 
                                   {{ old('in_relationship', $slambook->in_relationship) ? 'checked' : '' }}
                                   class="peer sr-only" />
                            <div class="bg-[#1a1f4a] border-2 border-[#252b5e] rounded-lg p-6 text-center transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-600/10 peer-checked:shadow-lg peer-checked:shadow-blue-600/30 hover:border-blue-500/50">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 peer-checked:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="block text-white font-medium">Yes</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" id="in_relationship_no" name="in_relationship" value="0" 
                                   {{ !old('in_relationship', $slambook->in_relationship) ? 'checked' : '' }}
                                   class="peer sr-only" />
                            <div class="bg-[#1a1f4a] border-2 border-[#252b5e] rounded-lg p-6 text-center transition-all duration-200 peer-checked:border-purple-500 peer-checked:bg-purple-600/10 peer-checked:shadow-lg peer-checked:shadow-purple-600/30 hover:border-purple-500/50">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 peer-checked:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="block text-white font-medium">No</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Dream Job Field -->
                <div class="space-y-2">
                    <label for="dream_job" class="block text-sm font-medium text-gray-300">Dream Job</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="text" id="dream_job" name="dream_job" value="{{ old('dream_job', $slambook->dream_job) }}"
                               class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="e.g., Software Engineer, Doctor, Artist..." required />
                    </div>
                </div>

                <!-- Motto Field -->
                <div class="space-y-2">
                    <label for="motto" class="block text-sm font-medium text-gray-300">Motto in Life</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <textarea id="motto" name="motto" rows="4"
                                  class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                                  placeholder="Share your life philosophy or guiding principle..." required>{{ old('motto', $slambook->motto) }}</textarea>
                    </div>
                </div>

                <!-- Three Words Field -->
                <div class="space-y-2">
                    <label for="three_words" class="block text-sm font-medium text-gray-300">Describe Yourself in 3 Words</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                        </div>
                        <textarea id="three_words" name="three_words" rows="4"
                                  class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                                  placeholder="e.g., Creative, Ambitious, Compassionate..." required>{{ old('three_words', $slambook->three_words) }}</textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 pt-6 border-t border-[#1a1f4a]">
                    <x-button type="submit" variant="primary">
                        <x-slot:icon>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </x-slot:icon>
                        Save Changes
                    </x-button>
                    <x-button type="button" variant="secondary" onclick="window.location='{{ url('/') }}'">
                        <x-slot:icon>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </x-slot:icon>
                        Cancel
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection