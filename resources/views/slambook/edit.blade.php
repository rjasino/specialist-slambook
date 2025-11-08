@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="card">
            <h2>Edit Your Slambook</h2>
            <form method="POST" action="{{ route('slambook.update', $slambook->id) }}">
                @csrf
                @method('PUT')
                <label for="name">Name: </label>
                <input type="text" id="name" name="name" value="{{ old('name', $name) }}" readonly />
                <br />
                <label for="age">Age: </label>
                <input type="text" id="age" name="age" value="{{ old('age', $slambook->age) }}" />
                <br />
                <label for="zodiac_sign">Zodiac Sign: </label>
                <select id="zodiac_sign" name="zodiac_sign">
                    @php
                    $zodiacSigns = [
                    'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
                    'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
                    ];
                    @endphp
                    @foreach ($zodiacSigns as $sign)
                    <option value="{{ $sign }}" {{ old('zodiac_sign', $slambook->zodiac_sign) == $sign ? 'selected' : ''
                        }}>
                        {{ $sign }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" id="zodiac_sign" name="zodiac_sign"
                    value="{{ old('zodiac_sign', $slambook->zodiac_sign) }}" /> --}}
                <br />

                <label for="in_relationship">In a relationship: </label>
                <div class="radio-group">
                    <input type="radio" id="in_relationship_yes" name="in_relationship" value="1" {{
                        old('in_relationship', $slambook->in_relationship) ? 'checked' : '' }} />
                    <label class="radio-label" for="in_relationship_yes">Yes</label>
                </div>
                <div class="radio-group">

                    <input type="radio" id="in_relationship_no" name="in_relationship" value="0" {{
                        !old('in_relationship', $slambook->in_relationship) ? 'checked' : '' }} />
                    <label class="radio-label" for="in_relationship_no">No</label>
                </div>
                <br />

                <label for="dream_job">Dream Job: </label>
                <input type="text" id="dream_job" name="dream_job"
                    value="{{ old('dream_job', $slambook->dream_job) }}" />
                <br />
                <label for="motto">Motto in life:</label>
                <input type="text" id="motto" name="motto" value="{{ old('motto', $slambook->motto) }}" />
                <br />
                <label for="three_words">Describe yourself in 3 words: </label>
                <input type="text" id="three_words" name="three_words"
                    value="{{ old('three_words', $slambook->three_words) }}" />

                <button type="submit" class="btn-primary">Save Changes</button>
                <button type="button" class="btn-secondary" onclick="window.location='{{ url('/') }}'">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection