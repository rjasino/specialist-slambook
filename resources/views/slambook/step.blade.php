@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Slambook Form</span>
        </h1>
        <p class="text-gray-400">Hello, {{ Auth::user()->name}}, please fill out your slambook!</p>
    </div>

    <!-- Progress Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-400">Progress</span>
            <span class="text-sm font-medium text-blue-400">Step {{ $step }} of 6</span>
        </div>
        <div class="w-full bg-[#1a1f4a] rounded-full h-3 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-3 rounded-full transition-all duration-500 shadow-lg shadow-blue-600/50" 
                 style="width: {{ ($step / 6) * 100 }}%"></div>
        </div>
        
        <!-- Step indicators -->
        <div class="flex justify-between mt-4">
            @for($i = 1; $i <= 6; $i++)
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold transition-all duration-300 {{ $i < $step ? 'bg-gradient-to-br from-blue-600 to-purple-600 text-white shadow-lg shadow-blue-600/30' : ($i == $step ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/50' : 'bg-[#1a1f4a] text-gray-500') }}">
                    {{ $i }}
                </div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
    <div class="bg-red-600/10 border border-red-600/50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-red-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="flex-1">
                <h3 class="text-red-400 font-medium mb-2">Please fix the following errors:</h3>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li class="text-red-300 text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Form Card -->
    <div class="bg-[#0d1135] border border-[#1a1f4a] rounded-lg overflow-hidden shadow-xl">
        <!-- Card Header -->
        @php
            $stepTitles = [
                1 => 'Personal Information',
                2 => 'Zodiac Sign',
                3 => 'Relationship Status',
                4 => 'Career Aspirations',
                5 => 'Life Philosophy',
                6 => 'Self Description'
            ];
        @endphp
        @include('layouts.header', ['title' => $stepTitles[$step], 'subtitle' => 'Step ' . $step . ' of 6'])

        <!-- Form Content -->
        <div class="p-6">
            <form method="POST" action="{{ route('slambook.process') }}">
                @csrf
                <input type="hidden" name="step" value="{{ $step }}">

                @if($step == 1)
                <div class="space-y-2">
                    <label for="age" class="block text-sm font-medium text-gray-300">What is your age?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input type="number" id="age" name="age" value="{{ old('age', $data['age'] ?? '') }}" min="1" max="120" 
                               class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="Enter your age" required>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Please enter your current age (1-120)</p>
                </div>
                @endif

                @if($step == 2)
                <div class="space-y-2">
                    <label for="zodiac_sign" class="block text-sm font-medium text-gray-300">What is your zodiac sign?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <select name="zodiac_sign" id="zodiac_sign" 
                                class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none" 
                                required>
                            <option value="" class="bg-[#1a1f4a]">Select your zodiac sign</option>
                            <option value="Aries" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Aries' ? 'selected' : '' }} class="bg-[#1a1f4a]">♈ Aries</option>
                            <option value="Taurus" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Taurus' ? 'selected' : '' }} class="bg-[#1a1f4a]">♉ Taurus</option>
                            <option value="Gemini" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Gemini' ? 'selected' : '' }} class="bg-[#1a1f4a]">♊ Gemini</option>
                            <option value="Cancer" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Cancer' ? 'selected' : '' }} class="bg-[#1a1f4a]">♋ Cancer</option>
                            <option value="Leo" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Leo' ? 'selected' : '' }} class="bg-[#1a1f4a]">♌ Leo</option>
                            <option value="Virgo" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Virgo' ? 'selected' : '' }} class="bg-[#1a1f4a]">♍ Virgo</option>
                            <option value="Libra" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Libra' ? 'selected' : '' }} class="bg-[#1a1f4a]">♎ Libra</option>
                            <option value="Scorpio" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Scorpio' ? 'selected' : '' }} class="bg-[#1a1f4a]">♏ Scorpio</option>
                            <option value="Sagittarius" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Sagittarius' ? 'selected' : '' }} class="bg-[#1a1f4a]">♐ Sagittarius</option>
                            <option value="Capricorn" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Capricorn' ? 'selected' : '' }} class="bg-[#1a1f4a]">♑ Capricorn</option>
                            <option value="Aquarius" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Aquarius' ? 'selected' : '' }} class="bg-[#1a1f4a]">♒ Aquarius</option>
                            <option value="Pisces" {{ old('zodiac_sign', $data['zodiac_sign'] ?? '') == 'Pisces' ? 'selected' : '' }} class="bg-[#1a1f4a]">♓ Pisces</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Choose your astrological sign</p>
                </div>
                @endif

                @if($step == 3)
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-300 mb-4">Are you in a relationship?</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="in_relationship" value="yes" 
                                   {{ old('in_relationship', $data['in_relationship'] ?? '') == 'yes' ? 'checked' : '' }} 
                                   class="peer sr-only" required>
                            <div class="bg-[#1a1f4a] border-2 border-[#252b5e] rounded-lg p-6 text-center transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-600/10 peer-checked:shadow-lg peer-checked:shadow-blue-600/30 hover:border-blue-500/50">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 peer-checked:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="block text-white font-medium">Yes</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="in_relationship" value="no" 
                                   {{ old('in_relationship', $data['in_relationship'] ?? '') == 'no' ? 'checked' : '' }} 
                                   class="peer sr-only" required>
                            <div class="bg-[#1a1f4a] border-2 border-[#252b5e] rounded-lg p-6 text-center transition-all duration-200 peer-checked:border-purple-500 peer-checked:bg-purple-600/10 peer-checked:shadow-lg peer-checked:shadow-purple-600/30 hover:border-purple-500/50">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 peer-checked:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="block text-white font-medium">No</span>
                            </div>
                        </label>
                    </div>
                </div>
                @endif

                @if($step == 4)
                <div class="space-y-2">
                    <label for="dream_job" class="block text-sm font-medium text-gray-300">What is your dream job?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="text" name="dream_job" id="dream_job" value="{{ old('dream_job', $data['dream_job'] ?? '') }}" 
                               class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="e.g., Software Engineer, Doctor, Artist..." required>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Share your career aspirations with us</p>
                </div>
                @endif

                @if($step == 5)
                <div class="space-y-2">
                    <label for="motto" class="block text-sm font-medium text-gray-300">What is your motto in life?</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <textarea name="motto" id="motto" rows="4" 
                                  class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                                  placeholder="Share your life philosophy or guiding principle..." required>{{ old('motto', $data['motto'] ?? '') }}</textarea>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">What words do you live by?</p>
                </div>
                @endif

                @if($step == 6)
                <div class="space-y-2">
                    <label for="three_words" class="block text-sm font-medium text-gray-300">Describe yourself in 3 words:</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                        </div>
                        <textarea name="three_words" id="three_words" rows="4" 
                                  class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                                  placeholder="e.g., Creative, Ambitious, Compassionate..." required>{{ old('three_words', $data['three_words'] ?? '') }}</textarea>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Choose three words that best represent who you are</p>
                </div>
                @endif

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-[#1a1f4a]">
                    <div>
                        @if($step > 1)
                        <x-button type="submit" name="previous" variant="secondary">
                            <x-slot:icon>
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </x-slot:icon>
                            Previous
                        </x-button>
                        @endif
                    </div>
                    <div>
                        @if($step < 6)
                        <x-button type="submit" name="next" variant="primary">
                            Next
                            <x-slot:icon iconPosition="right">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </x-slot:icon>
                        </x-button>
                        @else
                        <x-button type="submit" name="submit" variant="success">
                            <x-slot:icon>
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </x-slot:icon>
                            Submit Slambook
                        </x-button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection