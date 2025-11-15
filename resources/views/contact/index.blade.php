@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Contact Us</span>
        </h1>
        <p class="text-gray-400">Get in touch with us. We'd love to hear from you!</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-600/10 border border-green-600/50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-green-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="flex-1">
                <p class="text-green-400 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Contact Form -->
        <div class="bg-[#0d1135] border border-[#1a1f4a] rounded-lg overflow-hidden shadow-xl">
            <!-- Card Header -->
            @include('layouts.header', ['title' => 'Send us a Message', 'subtitle' => 'Fill out the form below and we\'ll get back to you'])

            <!-- Form Content -->
            <div class="p-6">
                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror" 
                                   placeholder="your.email@example.com" required />
                        </div>
                        @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number Field -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-medium text-gray-300">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('phone') border-red-500 @enderror" 
                                   placeholder="+1 (555) 123-4567" required />
                        </div>
                        @error('phone')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address Field -->
                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-300">Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                   class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('address') border-red-500 @enderror" 
                                   placeholder="123 Main St, City, Country" required />
                        </div>
                        @error('address')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Field -->
                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-medium text-gray-300">Message</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <textarea id="message" name="message" rows="5"
                                      class="w-full bg-[#1a1f4a] border border-[#252b5e] text-white rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('message') border-red-500 @enderror" 
                                      placeholder="Tell us how we can help you..." required>{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <x-button type="submit" variant="success" class="w-full justify-center">
                            <x-slot:icon>
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </x-slot:icon>
                            Send Message
                        </x-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Map and Contact Info -->
        <div class="space-y-6">
            <!-- Google Map -->
            <div class="bg-[#0d1135] border border-[#1a1f4a] rounded-lg overflow-hidden shadow-xl">
                @include('layouts.header', ['title' => 'Our Location', 'subtitle' => 'Find us on the map'])
                <div class="p-6">
                    <div id="map" class="w-full h-80 rounded-lg overflow-hidden bg-[#1a1f4a]"></div>
                </div>
            </div>

            <!-- Contact Information Cards -->
            <div class="bg-[#0d1135] border border-[#1a1f4a] rounded-lg overflow-hidden shadow-xl">
                @include('layouts.header', ['title' => 'Contact Information', 'subtitle' => 'Reach out to us anytime'])
                <div class="p-6 space-y-4">
                    <!-- Email -->
                    <div class="flex items-start bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e]">
                        <div class="w-10 h-10 rounded-full bg-blue-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Email</p>
                            <p class="text-white font-medium mt-1">contact@slambook.com</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e]">
                        <div class="w-10 h-10 rounded-full bg-purple-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Phone</p>
                            <p class="text-white font-medium mt-1">+1 (555) 123-4567</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="flex items-start bg-[#1a1f4a] rounded-lg p-4 border border-[#252b5e]">
                        <div class="w-10 h-10 rounded-full bg-indigo-600/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Address</p>
                            <p class="text-white font-medium mt-1">123 Main Street, Suite 100<br>San Francisco, CA 94102</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Google Maps Script -->
<script>
    function initMap() {
        // Default coordinates (San Francisco)
        const location = { lat: 37.7749, lng: -122.4194 };
        
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: location,
            styles: [
                {
                    "elementType": "geometry",
                    "stylers": [{"color": "#1a1f4a"}]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [{"color": "#8ec3b9"}]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [{"color": "#0a0e27"}]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#252b5e"}]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{"color": "#252b5e"}]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [{"color": "#252b5e"}]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#1a1f4a"}]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{"color": "#0d1135"}]
                }
            ]
        });
        
        const marker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Slambook Office"
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap"></script>
@endsection
